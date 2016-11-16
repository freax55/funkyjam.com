<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/ShopAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/paygent/Paygent.php');

class Action extends ShopAction {
	function init() {
		DatabaseAction::init();

		define('AFF_NO', '01051590');
		define('AFF_NAME', 'BARI BARI CREW GOODS');
		define('RET_URL', '/mori/insert/index.php?action=complete&');
		//テスト環境のみ上書き
		if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
			define('RET_URL', 'http://test.funkyjam.com/mori/insert/index.php?action=complete&');
		}
		define('OMC_URL', 'https://www2.e-colle.com/settlement/xt_pay_funkyjam.asp');
	}

	function prepare() {
	}
		
	function execute() {
		$db =& $this->_db;
		//入会金をプラスする
		$insert_price = 500;
		$this->itemList["moriYearsPass"]["price"] = $this->itemList["moriYearsPass"]["price"]+$insert_price;
		//コンビニ決済の時は決済手数料を加える

		if($this->payment == 'コンビニ決済') {
			$cvs_price = 250;
			$this->itemList["moriYearsPass"]["price"] = $this->itemList["moriYearsPass"]["price"]+$cvs_price;
		}
		//DB登録処理
		if ($this->payment != '銀行ネット決済') {
			$this->addOrder();
		}

		//前に識別用の値を入れる
		$tid = $this->p04;
		$set = "MD";
		$set .= $this->p04;
		$this->p04 = $set;

		$_SESSION["p04"] = $tid;
		$_SESSION["p15"] = $this->p15;
		$_SESSION["p16"] = $this->p16;

		/**
		 * ペイジェント用処理
		 */
		$total = 0;
		foreach($this->cart as $item) {
			$total += $this->itemList[$item['item_code']]['price']*$item['quantity'];
		}

		$p = new Paygent();
		$p->init();

		$trading_id = $this->p04;
		$payment_id = '';

		$params = array(
			"merchant_id" => MERCHANT_ID,
			"connect_id" => CONNECT_ID,
			"connect_password" => CONNECT_PASSWORD,
			"telegram_kind" => '',
			"telegram_version" => TELEGRAM_VERSION,
			"trading_id" => $trading_id,
			"payment_id" => $payment_id
		);

		/*
		 * telegram_kindについては
		 * 電文種別を表す3桁の数字を渡す
		 *
		 * 010：ATM決済申込
		 * 020：カード決済オーソリ
		 * 021：カード決済オーソリキャンセル
		 * 022：カード決済売上
		 * 023：カード決済売上キャンセル
		 * 024：カード決済3Dオーソリ
		 * 028：カード決済オーソリ減額
		 * 029：カード決済売上減額
		 * 025：カート情報設定電文
		 * 026：カート情報削除電文
		 * 027：カート情報照会電文
		 * 030：コンビニ決済(番号方式)申込
		 * 040：コンビニ決済(払込票方式)申込
		 * 050：銀行ネット決済申込
		 * 060：銀行ネット決済ASP
         * 070：仮想口座決済
         * 091：決済情報差分照会
         */
		if ($this->payment == 'コンビニ決済') {
			$params['telegram_kind'] = '030';
			$params['payment_amount'] = $total;
			$params['customer_family_name'] = $this->last_name;
			$params['customer_name'] = $this->first_name;
			$params['customer_tel'] = mb_ereg_replace('-', '', $this->tel);
			//入金までの猶予は２日間に
			$params['payment_limit_date'] = 2;

			//05/20追加
			$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no");
			$this->cvs_company_id = $convenience_stores[$this->convenience_store_no]["cvs_company_id"];
			$params['cvs_company_id'] = $this->cvs_company_id;

			/*
			 * cvs_company_idについては
			 * コンビニ企業をあらわすコードで
			 * 選択されたコンビニによって変更する必要がある。
			 *
			 * 00C016 セイコーマート
			 * 00C002 ローソン
			 * 00C004 ミニストップ
			 * 00C007 サークルK
			 * 00C006 サンクス
			 * 00C014 デイリーヤマザキ
			 * 00C001 セブンイレブン
			 * 00C005 ファミリーマート
			 */
			$params['sales_type'] = '1';
		} elseif ($this->payment == 'カード決済（ペイジェント）') {

			$this->card_number = $this->card_no01 . $this->card_no02 . $this->card_no03 . $this->card_no04;
			$this->card_valid_term = $this->valid_term01 . $this->valid_term02;

			$params['telegram_kind'] = '020';
			$params['payment_amount'] = $total;
			$params['card_number'] = $this->card_number;
			$params['card_valid_term'] = $this->card_valid_term;

			/*
			 * payment_class
			 * 支払区分
			 * 1回払い固定
			 *
			 *「10」：1回払い
			 *「23」：ボーナス1回
			 *「61」：分割
			 *「80」：リボルビング
			 */
			$this->payment_class = 10;
			$params['payment_class'] = $this->payment_class;

			/*
			 * 3dsecure_ryaku
			 * 3Dセキュア不要区分
			 */
			$this->dsecure_ryaku = 1;
			$params['3dsecure_ryaku'] = $this->dsecure_ryaku;

		}

		$p->set($params);
		$response = $p->run();

		if(empty($response)) {
			$this->errorDestructor();
		}elseif($response['resultStatus'] != 0) {
			$this->errorDestructor();
		}elseif(empty($response[0]["payment_id"])){
			$this->errorDestructor();
		}
		foreach($response as $res) {

			if($res['result'] == 0) {

				$this->payment_id = $res['payment_id'];
				$this->trading_id = $res['trading_id'];

				if(!empty($res)){
					if($this->payment == 'コンビニ決済') {
						$this->setConvenienceStoreData($res);
						$this->saveCheckoutData($res,$tid);
						$this->convenience_store_item = $this->saveConvenienceStoreData($res,$tid,$this->tel);

					} elseif ($this->payment == 'カード決済（ペイジェント）') {
						$this->setCardData($res);
						$this->saveCheckoutData($res,$tid);

					}
				}
				$this->__controller->redirectToURL('index.php?action=complete');
				return false;
			}
		}
		return false;
	}
	
	function validate() {
		$this->errors = array();
		if(empty($this->convenience_store_no) && $this->payment == 'コンビニ決済') {
			$this->errors['convenience_store_no'] = 'お支払いになるコンビニを選択して下さい。';
			return 'select';
			
		}elseif($this->payment == 'カード決済（ペイジェント）'){
			
			if(!preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/', "{$this->card_no01}{$this->card_no02}{$this->card_no03}{$this->card_no04}")){
				$this->errors['card_no'] = '有効なカード番号を入力してください';
			}
			if (!$this->valid_term01 && !$this->isNumber($this->valid_term01) || mb_strlen($this->valid_term01) != 2) {
				$this->errors['valid_term'] = '選択してください。';
			} elseif(!$this->valid_term02 && !$this->isNumber($this->valid_term02) || mb_strlen($this->valid_term02) != 2) {
				$this->errors['valid_term'] = '選択してください。';
			} elseif(strtotime("20{$this->valid_term02}-{$this->valid_term01}-01") < strtotime(date("Y-m-d")) ) {
				$this->errors['valid_term'] = '有効期限が無効です。';
			}

			if (count($this->errors)) {
				return 'select';
			}
			
		}

		return true;
	}
	function genTrnid1($order_desc_no, $price, $member_no) {
		$params = array();
		$p01 = AFF_NO;
		$a02 = AFF_NAME;
		$a04 = $order_desc_no;
		$a05 = $price;
		$a07 = RET_URL;
		$a08 = $member_no;
		$a09 = '01';
		$a10 = '1';

		$argument = "\"$p01\" \"$a02\" \"$a04\" \"$a05\" \"$a07\" \"$a08\" \"$a09\" \"$a10\"";
		$cmd = '/home/funkyjam/lib/omc/trnid1gen ' . $argument;
		$trnid1 = `$cmd`;

		return $trnid1;
	}
}
?>