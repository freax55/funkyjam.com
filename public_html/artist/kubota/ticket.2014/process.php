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



		//DB��Ͽ����
		$this->addOrder();
		//�����ͤ������
		$tid = $this->p04;
		$set = "KT";
		$set .= $this->p04;
		$this->p04 = $set;

		$_SESSION["p04"] = $tid;
		$_SESSION["p15"] = $this->p15;
		$_SESSION["p16"] = $this->p16;

		if ($this->payment == '���쥸�åȥ�����') {
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
		if ($this->payment == 'ͽ��') {
			$this->__controller->redirectToURL('index.php?action=complete');
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
			$params['payment_limit_date'] = $this->getPaymentLimitDate($_SESSION["loginID"]['ticket']);
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
		} elseif ($this->payment == 'ATM���') {
			$params['telegram_kind'] = '010';
			$params['payment_amount'] = $total + $this->carriageTotal;
			$params['payment_detail'] = '�ե��󥭡�����ྦ�����';
			$params['payment_detail_kana'] = '�̎��ݎ�-���ގԎю��֎��ˎݎ��ގ�����';
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
					if($this->payment == '����ӥ˷��') {
						$this->setConvenienceStoreData($res);
						$this->saveCheckoutData($res,$tid);
						$this->convenience_store_item = $this->saveConvenienceStoreData($res,$tid,$this->tel);
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
		 * �����̤�ʤ�С�toursalelist�ˤ�1�路������ʤ��Ϥ�
		 * intval�ǡ�3 Days�פ��1 Day�פ��00��00�פϵۼ��Ǥ��Ƥ���
		 * $limiDate�ˤϡ����������äƤ���Τǡ�����Ū�ˤϤ����return�����OK
		 * ��������5������Ĺ�����ϡ�5���֤�����
		 */
		 
		
		//�ӡ��ȥ��ͥ������δ��¤����ꤹ�뤿���DB�˥ĥ����ǤϤʤ����ǡ������Ѱա�
		//�ѥ���ɤ������Ǥ��ʤ��ä����ᡢ���ߤΥѥ���ɤ��ư����

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
		// //5�����¤���
		// if($limitDate > 5) {
		// 	$limitDate = 5;
		// }
		// $limitDate = 5;


		//12/7����ʬ�ޤ�12/9 23��59�ޤ�,12/8��9����ʬ��12/11 23��59�ޤ�

		//2013ǯ�ε����ĥĥ����Ѥ�Ĵ��
		//���ߤ����դ��顢��������դޤǤ��������
		$today = getdate();
		$today_month = $today['mon'];
		$today_day = $today['mday'];
		$today_year = $today['year'];
		$now = mktime(0, 0, 0, $today_month, $today_day, $today_year);
		//$now = mktime(23, 59, 59, 8, 29, 2013);

		// 12/7 23��59�ޤǤμ���ʬ
		$end1 = mktime(23, 59, 59, 12, 7, 2014);
		// 12/8 0��00��12/9 23��59����ʬ
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