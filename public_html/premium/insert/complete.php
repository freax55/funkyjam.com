<?php
/**
 * $this->_other_mail�䡢$tourGoodsList�ʤɤ�
 * 2003ǯ���ε����������Υĥ������å�����κݤ˻��Ѥ����ѥ�᡼����
 * �ĥ������å���category_code='A013'�Ȥ������ƥ���ˤʤäƤ��롣
 * ����ϡ��ĥ������å������̤β�Ҥ��������Ƥ����ΤǤ��Τ褦���б���ɬ�פȤʤä���
 * 2010ǯ�Υĥ������å��ˤĤ��Ƥϡ�funkyjam�Ǵ�����
 * ��������פˤʤ뤫�⤷��ޤ��󡣤�����ե�������󥰤λ��֤��ʤ��ΤǤȤꤢ�����ޥޤǤ���
 *
 * 2010/10/01 �и�
 */


//ini_set('display_errors', 'on');
//error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	var $__defaultPage = null;
	var $__defaultAmount = null;
	var $__defaultPageAmount = null;
	
	function init() {
		DatabaseAction::init();
		
		$this->__defaultPage = 1;
		$this->__defaultAmount = 20;
		$this->__defaultPageAmount = 5;
	}

	function prepare() {
		if($this->status == "edit"){
			$this->_subject = '��FJ PREMIUM����Ͽ�ι�����ǯ���񤪻�ʧ�ˤĤ���';
		}
		else{
			$this->_subject = '��FJ PREMIUM��ǯ���񤪻�ʧ���ˤĤ���';
		}

		$this->_system_name = 'FJ�ץ�ߥ���ڡ���';
		//$this->_system_mail = 'kida@evol-ni.jp';
		//$this->_other_mail = 'kida@evol-ni.jp';
		$this->_system_mail = 'premium@funkyjam.com';
		$this->_other_mail = 'premium@funkyjam.com';
		$this->_other_mail_code = 'A013';

		$this->confirm_mail = 'kida@evol-ni.com';
	}
	
	function execute() {
		$db =& $this->_db;

		$this->p04 = $_SESSION["p04"];
		
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());

		$order_desc_no = $this->p04;
		$result_code = $this->p15;
		$detail_code = $this->p16;
		
		//�᡼�����
		//order
		$db->assign('order_desc_no', $order_desc_no);
		$result = $db->statement('premium/insert/sql/order_list.sql');
		$tree = $db->buildTree($result, 'order_no');
		$orderList = $tree;
		$noTourGoodsList = $tree;
		
		//�᡼����������˿���ʬ��
		$tourGoodsList = array();
		foreach($noTourGoodsList as $order) {
			if($order['category_code'] == $this->_other_mail_code){
				$tourGoodsList[] = $noTourGoodsList[$order['order_no']];
				unset($noTourGoodsList[$order['order_no']]);
			}
		}
		
		//order_desc
		$result = $db->statement('premium/insert/sql/order_desc_list.sql');
		$row = $db->fetch_assoc($result);
		$mailer->assign('orderDesc', $row);

		$type = "";
		if ($row['payment'] == "����ӥ˷��") {
			$this->_subject .= "�ʥ���ӥ˷�ѡ�";
		}
		elseif ($row['payment'] == "�����ɷ�ѡʥڥ�������ȡ�") {
			$this->_subject .= "�ʥ��쥸�åȥ����ɡ�";
		}

		if ($this->mail) {
			$customer = $this->convertEncodingHeader($row['name']) . '<' . $this->mail . '>';
		}
		else {
			$customer = $this->_system_mail;
		}
		
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);

		$start = date("Y-m-d", mktime(0, 0, 0, date("n"), 1, date("Y")));
		$end = date("Y-m-d", mktime(0, 0, 0, date("n")+1, 1-1, date("Y")+1));

		$start_mail = date("Y-m-d", mktime(0, 0, 0, date("n"), 1, date("Y")+1));
		$db->begin();
		$db->assign('mail', $this->mail);
		$db->assign('member_no', $this->member_no);
		$db->assign('start', $start);
		$db->assign('end', $end);
		$db->assign('start_mail', $start_mail);
		foreach($orderList as $o_id) {
			$db->assign('order_no', $o_id['order_no']);
			$db->assign('order_desc_no', $o_id['order_desc_no']);
		}
		//�������������¸�ե�����ɤ˥ǡ����������
		if($this->status == "edit"){
			$db->statement('premium/insert/sql/update_premium.sql');
		}
		//��Ͽ����
		else{
			$db->statement('premium/insert/sql/insert_premium.sql');
		}
		$db->commit();
		if ($row['payment'] == "����ӥ˷��") {
			//FunkyJam�إ᡼������
			//����ӥˡ�ATM����ԥͥåȤˤĤ��Ƥϡ���ͽ��פȤ��ơ�FJ�����Τ��롣
			$mailer->assign('admin', 0);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			//����8����֤äƤ���Τǡ����դȤ���ɽ�������롣�������󤷤ʤ�����
			$payment_limit_date = $this->__limitDateFormat($this->payment_limit_date);
			$mailer->assign("payment_limit_date", $payment_limit_date);

			$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no");
			$mailer->assign("convenience_stores", $convenience_stores);

			$body = $mailer->fetch('premium/insert/mail_paygent_cvs.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader($this->_subject . '��ͽ���'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('insert/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('premium/insert/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		elseif ($row['payment'] == "�����ɷ�ѡʥڥ�������ȡ�") {
			//FunkyJam�إ᡼������
			$mailer->assign('admin', 1);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $subject, $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			/*
			 * ��������Ѥ��줿���ˡ�d_stamp��null�ˤ���
			 * ��ѳ���ޤǤ˻��ֺ���������ϡ�����Υ����ߥ󥰤�d_stamp��null�ˤ���
			 */
			$db->begin();
			foreach($orderList as $orderRow) {
				$db->assign('order_no', $orderRow['order_no']);
				$db->statement('premium/insert/sql/update_order.sql');
			}
			$db->statement('premium/insert/sql/update_order_desc.sql');
			$db->commit();

			/*
			 * ��������������Ѥ��줿���ˡ�u_���������꡼���ʰ����¸�ե�����ɡˤ�����null�ˤ��ơ�
			 * �ܥե�����ɤ˾�񤭤���
			 */
			if($this->status == "edit"){
				$db->begin();
				$db->statement('premium/insert/sql/update_premium_card_user.sql');
				$db->commit();
			}
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('premium/insert/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		else {
			return 'error';
		}
		$root = "";
		$root = $this->status;
		$_SESSION['login_id'] = NULL;
		unset($this->login_flg);
		$this->clearProperties();
		if($root == "edit"){
			$this->__controller->redirectToAction('end_edit');
		}
		else{
			$this->__controller->redirectToAction('end');
		}
		
		return false;
	}

	/**
	 * Convert display encoding.
	 * @access private
	 * @return string
	 */
	function convertEncodingDisplay($str, $enc = 'EUC-JP') {
		$str = mb_convert_encoding($str, $enc, 'JIS');

		return $str;
	}

	/**
	 * Convert mail body encoding.
	 * @access private
	 * @return string
	 */
	function convertEncodingBody($str, $enc = 'EUC-JP') {
		$str = mb_convert_encoding($str, 'JIS', $enc);

		return $str;
	}

	/**
	 * Convert mail header encoding.
	 * @access private
	 * @return string
	 */
	function convertEncodingHeader($str, $enc = 'EUC-JP') {
		$str = $this->convertEncodingBody($str, $enc);
		$str = '=?iso-2022-jp?B?' . base64_encode($str) . '?=';

		return $str;
	}

	/**
	 * Send mail.
	 * @access private
	 */
	function send($to, $subject, $body, $from) {
		mail($to, $subject, $body, "From: " . $from);
	}

	function fold($str, $length = 70, $enc = 'EUC-JP') {
		$str = str_replace("\r\n", "\n", $str);
		$str = str_replace("\r", "\n", $str);
		$lines = mb_split("\n", $str);
		
		foreach($lines as $key => $line) {
			$works = '';
			$pos = 0;
			while ($pos + $length < strlen($line)) {
				$works .= mb_strcut($line, $pos, $length, $enc) . "\n";
				$pos += $length;
			}
			$lines[$key] = $works . mb_strcut($line, $pos);
		}
		
		return implode("\n", $lines);
	}

	function validate() {
		return true;

	}


	function __limitDateFormat($limitDate){
		return mb_ereg_replace('([0-9]{4})([0-9]{2})([0-9]{2})', "\\1ǯ\\2��\\3��", $limitDate);
	}

}
?>