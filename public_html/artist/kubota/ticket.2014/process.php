<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/ShopAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/paygent/Paygent.php');

class Action extends ShopAction {
	function init() {
		DatabaseAction::init();
		
		define('AFF_NO', '01051580');
		define('AFF_NAME', 'BARI BARI CREW TICKET');
		define('RET_URL', 'https://www.funkyjam.com/artist/kubota/ticket/index.php?action=complete&');
		define('OMC_URL', 'https://www2.e-colle.com/settlement/xt_pay_funkyjam.asp');
		
		if(!$_SESSION["loginID"]['ticket']) {
			unset($_SESSION["loginID"]);
			$this->__controller->redirectToURL('/artist/kubota/login_tour/');
			exit();
		}
	}

	function execute() {
		
		$db =& $this->_db;




		//Mail Magazine Quick Entry
		if ($this->form['magazine']) {
			$this->form['mail'] = $this->mail;
			$result = $this->dbTable("magazine", null, null, sprintf("d_stamp is null and mail='%s'", $this->form['mail']), "mail");
			if(!$result) {
				$this->dbExec('magazine/sql/quick.sql');
			}
		}



		//DB登録処理
		$this->addOrder();
		//前に値を入れる
		$tid = $this->p04;
		$set = "KT";
		$set .= $this->p04;
		$this->p04 = $set;

		$_SESSION["p04"] = $tid;
		$_SESSION["p15"] = $this->p15;
		$_SESSION["p16"] = $this->p16;

		if ($this->payment == 'クレジットカード') {
			if ($this->payment == 'クレジットカード') {

				$price = $this->total + $this->carriageTotal;
				$trnid1 = $this->genTrnid1($this->p04, $price, $this->member_no);

				$params = array();
				$params[] = 'p01=' . AFF_NO;
				$params[] = 'p02=' . urlencode(mb_convert_encoding(AFF_NAME, 'SJIS', 'EUC-JP'));
				$params[] = 'p03=' . $trnid1;
				$params[] = 'p04=' . urlencode($this->p04);
				$params[] = 'p05=' . $price;
				$params[] = 'p06=' . date('Ymd');
				$params[] = 'p07=' . urlencode(RET_URL);
				$params[] = 'p08=' . urlencode($this->member_no);
				$params[] = 'p09=' . '01';
				$params[] = 'p10=' . '1';

				$url = OMC_URL . "?" . implode('&', $params);

				$this->__controller->redirectToURL($url);
			}
			else {
				$this->__controller->redirectToAction('complete');
			}

			return false;
		}
		if ($this->payment == '予約') {
			$this->__controller->redirectToURL('index.php?action=complete');
			return false;
		}

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
			$params['payment_amount'] = $total + $this->carriageTotal;
			$params['customer_family_name'] = $this->last_name;
			$params['customer_name'] = $this->first_name;
			$params['customer_tel'] = mb_ereg_replace('-', '', $this->tel);
			$params['payment_limit_date'] = $this->getPaymentLimitDate($_SESSION["loginID"]['ticket']);
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
		} elseif ($this->payment == 'ATM決済') {
			$params['telegram_kind'] = '010';
			$params['payment_amount'] = $total + $this->carriageTotal;
			$params['payment_detail'] = 'ファンキージャム商品代金';
			$params['payment_detail_kana'] = 'ﾌｱﾝｷ-ｼﾞﾔﾑｼﾖｳﾋﾝﾀﾞｲｷﾝ';
			$params['payment_limit_date'] = $this->getPaymentLimitDate($_SESSION["loginID"]['ticket']);
			
		}

		$p->set($params);


		$response = $p->run();



		if(empty($response)) {
			exit();
			$this->errorDestructor();
		}elseif($response['resultStatus'] != 0) {
			exit();
			$this->errorDestructor();
		}elseif(empty($response[0]["payment_id"])){
			exit();
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
					} elseif ($this->payment == 'ATM決済') {
						$this->setATMData($res);
						$this->saveCheckoutData($res,$this->p04);
						$this->saveATMData($res,$this->p04);
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
			return 'confirm';
			
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
	
	/**
	 * 
	 */
	function addOrder(){
		
		
		set_error_handler(array(&$this,"catchError"));
		$this->dbBigen();
		$this->dbExec('artist/kubota/ticket/sql/lock_table.sql');
		$this->p04 = $this->getNextOrderNo();
		foreach($this->cart as $value){
			$this->item = $value;
			$this->dbExec('artist/kubota/ticket/sql/insert_order.sql');
		}
		$this->dbExec('artist/kubota/ticket/sql/insert_order_desc.sql');
		$this->dbCommit();
	}
	
	/**
	 * 
	 * @return int 
	 */
	function getPaymentLimitDate($password) {
		/*
		 * 仕様通りならば、toursalelistには1件しか入らないはず
		 * intvalで「3 Days」や「1 Day」や「00：00」は吸収できている
		 * $limiDateには、整数が入っているので、基本的にはそれをreturnすればOK
		 * ただし、5日よりも長い場合は、5を返すこと
		 */
		 
		
		//ビートコネクションの期限を設定するためにDBにツアーではないがデータを用意。
		//パスワードが取得できなかったため、現在のパスワードを手動入力

		// $password = 'test';
		 
		// $toursaleList = $this->dbTable('toursale', 'password', null, "password = '{$password}' AND start_date <= current_timestamp AND end_date >= current_timestamp", "date_trunc('day', payment_end_date) - date_trunc('day', current_timestamp) AS limit");
		// if(count($toursaleList)) {
		// 	$limitDate = intval($toursaleList[0]['limit']);
		// } else {
		// 	$this->errorDestructor();
		// }
		// if($limitDate == 0) {
		// 	$this->errorDestructor();
		// }
		// //5日制限を解除
		// if($limitDate > 5) {
		// 	$limitDate = 5;
		// }
		// $limitDate = 5;


		//12/7受付分まで12/9 23：59まで,12/8・9受付分は12/11 23：59まで

		//2013年の久保田ツアー用に調整
		//現在の日付から、特定の日付までを取得する
		$today = getdate();
		$today_month = $today['mon'];
		$today_day = $today['mday'];
		$today_year = $today['year'];
		$now = mktime(0, 0, 0, $today_month, $today_day, $today_year);
		//$now = mktime(23, 59, 59, 8, 29, 2013);

		// 12/7 23：59までの受付分
		$end1 = mktime(23, 59, 59, 12, 7, 2014);
		// 12/8 0：00ー12/9 23：59受付分
		$end2 = mktime(23, 59, 59, 12, 9, 2014);

		if($now<$end1){
			$limit = mktime(23, 59, 59, 12, 9, 2014);
		}elseif($now<$end2){
			$limit = mktime(23, 59, 59, 12, 11, 2014);
		}

		//$limit = mktime(23, 59, 59, 9, 1, 2013);

		$limitDate = $limit - $now;
		$limitDate = floor($limitDate / (60 * 60 * 24));

		// echo $limitDate;

		// exit();

		return $limitDate;
	}
}
?>