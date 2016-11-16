<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/ShopAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/paygent/Paygent.php');

class Action extends ShopAction {
	var $__defaultPage = null;
	var $__defaultAmount = null;
	var $__defaultPageAmount = null;
	
	function init() {
		DatabaseAction::init();
		
		$this->__defaultPage = 1;
		$this->__defaultAmount = 20;
		$this->__defaultPageAmount = 5;
		define('AFF_NO', '01051590');
		define('AFF_NAME', 'BARI BARI CREW GOODS');
		define('RET_URL', '/shop/index.php?action=complete&');
		define('OMC_URL', 'https://www2.e-colle.com/settlement/xt_pay_funkyjam.asp');
	}

	function prepare() {
		if (!$this->page) {
			$this->page = $this->__defaultPage;
		}
		if (!isset($this->amount)) {
			$this->amount = $this->__defaultAmount;
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


		//DB��Ͽ����

		if ($this->payment != '��ԥͥåȷ��') {
			$this->addOrder();
		}

		$_SESSION["p04"] = $this->p04;
		$_SESSION["p15"] = $this->p15;
		$_SESSION["p16"] = $this->p16;


		if ($this->payment == '���쥸�åȥ�����'
				|| $this->payment == '͹�ؿ���'
				|| $this->payment == '������') {

			if ($this->payment == '���쥸�åȥ�����') {

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


		/**
		 * �ڥ���������ѽ���
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
		 * telegram_kind�ˤĤ��Ƥ�
		 * ��ʸ���̤�ɽ��3��ο������Ϥ�
		 *
		 * 010��ATM��ѿ���
		 * 020�������ɷ�ѥ�������
		 * 021�������ɷ�ѥ������ꥭ��󥻥�
		 * 022�������ɷ�����
		 * 023�������ɷ����奭��󥻥�
		 * 024�������ɷ��3D��������
		 * 028�������ɷ�ѥ������긺��
		 * 029�������ɷ����帺��
		 * 025�������Ⱦ���������ʸ
		 * 026�������Ⱦ�������ʸ
		 * 027�������Ⱦ���Ȳ���ʸ
		 * 030������ӥ˷��(�ֹ�����)����
		 * 040������ӥ˷��(ʧ��ɼ����)����
		 * 050����ԥͥåȷ�ѿ���
		 * 060����ԥͥåȷ��ASP
         * 070�����۸��·��
         * 091����Ѿ���ʬ�Ȳ�
         */
		if ($this->payment == '����ӥ˷��') {
			$params['telegram_kind'] = '030';
			$params['payment_amount'] = $total + $this->carriageTotal;
			$params['customer_family_name'] = $this->last_name;
			$params['customer_name'] = $this->first_name;
			$params['customer_tel'] = mb_ereg_replace('-', '', $this->tel);
			$params['payment_limit_date'] = 5;

			//05/20�ɲ�
			$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no");
			$this->cvs_company_id = $convenience_stores[$this->convenience_store_no]["cvs_company_id"];
			$params['cvs_company_id'] = $this->cvs_company_id;

			/*
			 * cvs_company_id�ˤĤ��Ƥ�
			 * ����ӥ˴�Ȥ򤢤�魯�����ɤ�
			 * ���򤵤줿����ӥˤˤ�ä��ѹ�����ɬ�פ����롣
			 *
			 * 00C016 ���������ޡ���
			 * 00C002 ������
			 * 00C004 �ߥ˥��ȥå�
			 * 00C007 ��������K
			 * 00C006 ���󥯥�
			 * 00C014 �ǥ��꡼��ޥ���
			 * 00C001 ���֥󥤥�֥�
			 * 00C005 �ե��ߥ꡼�ޡ���
			 */
			$params['sales_type'] = '1';
		} elseif ($this->payment == '�����ɷ�ѡʥڥ�������ȡ�') {

			$this->card_number = $this->card_no01 . $this->card_no02 . $this->card_no03 . $this->card_no04;
			$this->card_valid_term = $this->valid_term01 . $this->valid_term02;

			$params['telegram_kind'] = '020';
			$params['payment_amount'] = $total + $this->carriageTotal;
			$params['card_number'] = $this->card_number;
			$params['card_valid_term'] = $this->card_valid_term;

			/*
			 * payment_class
			 * ��ʧ��ʬ
			 * 1��ʧ������
			 *
			 *��10�ס�1��ʧ��
			 *��23�ס��ܡ��ʥ�1��
			 *��61�ס�ʬ��
			 *��80�ס���ܥ�ӥ�
			 */
			$this->payment_class = 10;
			$params['payment_class'] = $this->payment_class;

			/*
			 * 3dsecure_ryaku
			 * 3D�����奢���׶�ʬ
			 */
			$this->dsecure_ryaku = 1;
			$params['3dsecure_ryaku'] = $this->dsecure_ryaku;

		} elseif ($this->payment == '��ԥͥåȷ��') {
			$params['telegram_kind'] = '060';
			$params['amount'] = $total + $this->carriageTotal;
			$params['claim_kana'] = '�̎��ݎ�-���ގԎю��֎��ˎݎ��ގ�����';
			$params['claim_kanji'] = '�ե��󥭡�����ྦ�����';
			$params['customer_family_name'] = $this->last_name;
			$params['customer_name'] = $this->first_name;
			$params['asp_payment_term'] = '0000030';

		} elseif ($this->payment == 'ATM���') {
			$params['telegram_kind'] = '010';
			$params['payment_amount'] = $total + $this->carriageTotal;
			$params['payment_detail'] = '�ե��󥭡�����ྦ�����';
			$params['payment_detail_kana'] = '�̎��ݎ�-���ގԎю��֎��ˎݎ��ގ�����';
			$params['payment_limit_date'] = 5;
			
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

		if ($this->payment == '��ԥͥåȷ��') {
			$response = $this->response;
		}
		foreach($response as $res) {
			if($res['result'] == 0) {

				$this->payment_id = $res['payment_id'];
				$this->trading_id = $res['trading_id'];

				if(!empty($res)){
					if($this->payment == '����ӥ˷��') {
						$this->setConvenienceStoreData($res);
						$this->saveCheckoutData($res,$this->p04);
						$this->convenience_store_item = $this->saveConvenienceStoreData($res,$this->p04,$this->tel);

					} elseif ($this->payment == '�����ɷ�ѡʥڥ�������ȡ�') {
						$this->setCardData($res);
						$this->saveCheckoutData($res,$this->p04);

					} elseif ($this->payment == '��ԥͥåȷ��') {
						$this->saveCheckoutData($res,$this->p04);

					} elseif ($this->payment == 'ATM���') {
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
		
		if(empty($this->convenience_store_no) && $this->payment == '����ӥ˷��') {
			
			$this->errors['convenience_store_no'] = '����ʧ���ˤʤ륳��ӥˤ����򤷤Ʋ�������';
			return 'confirm';
			
		}elseif($this->payment == '�����ɷ�ѡʥڥ�������ȡ�'){
			
			if(!preg_match('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/', "{$this->card_no01}{$this->card_no02}{$this->card_no03}{$this->card_no04}")){
				$this->errors['card_no'] = 'ͭ���ʥ������ֹ�����Ϥ��Ƥ�������';
			}
			if (!$this->valid_term01 && !$this->isNumber($this->valid_term01) || mb_strlen($this->valid_term01) != 2) {
				$this->errors['valid_term'] = '������򤷤Ƥ���������';
			} elseif(!$this->valid_term02 && !$this->isNumber($this->valid_term02) || mb_strlen($this->valid_term02) != 2) {
				$this->errors['valid_term'] = 'ǯ�����򤷤Ƥ���������';
			} elseif(strtotime("20{$this->valid_term02}-{$this->valid_term01}-01") < strtotime(date("Y-m-d")) ) {
				$this->errors['valid_term'] = 'ͭ�����¤�̵���Ǥ���';
			}

			if (count($this->errors)) {
				return 'confirm';
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