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
		$this->_subject = '�������ƤΤ���ǧ';
		$this->_system_name = 'FJ SHOP�᡼�륪������';
		$this->_system_mail = 'shop@funkyjam.com';
		$this->_other_mail = 'shop@funkyjam.com';
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
		$result = $db->statement('shop/sql/order_list.sql');
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
		$result = $db->statement('shop/sql/order_desc_list.sql');
		$row = $db->fetch_assoc($result);

		if($row['payment'] == "����ӥ˷��" || $row['payment'] == "��ԥͥåȷ��" || $row['payment'] == "ATM���") {
			$row['paygentCarriage'] = 700;
			if($this->total + $row['paygentCarriage'] >= 10000) {
				$row['paygentFee'] = 240;
			} else {
				$row['paygentFee'] = 200;
			}
		}
		
		$mailer->assign('orderDesc', $row);

		if ($this->mail) {
			$customer = $this->convertEncodingHeader($row['name']) . '<' . $this->mail . '>';
		}
		else {
			$customer = $this->_system_mail;
		}
		
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		
		if ($result_code == '0' && $detail_code == '00') {
			//FunkyJam�إ᡼������
			$mailer->assign('admin', 1);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('shop/mail_card.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $subject, $body, $customer);
		
			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;
				
				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		elseif ($row['payment'] == "͹�ؿ���") {
			//FunkyJam�إ᡼������
			$mailer->assign('admin', 1);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$payment_limit_date = $this->__limitDateFormat(date('Ymd', mktime(0, 0, 0, date("m"), date("d")+14, date("Y"))));
			$mailer->assign("payment_limit_date", $payment_limit_date);

			$body = $mailer->fetch('shop/mail_postal.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader($this->_subject . '��͹����'), $body, $customer);
		
			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_postal.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_postal.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}
			
			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;
				
				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_postal.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		elseif ($row['payment'] == "������") {
			//FunkyJam�إ᡼������
			$mailer->assign('admin', 1);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('shop/mail_substitution.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $subject, $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_substitution.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_substitution.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_substitution.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}

		elseif ($row['payment'] == "����ӥ˷��") {
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

			$body = $mailer->fetch('shop/mail_paygent_cvs.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader($this->_subject . '��ͽ���'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();

			$this->clearProperties( array("convenience_store_no" , "convenience_store_item" ) );

			$this->convenience_stores = $convenience_stores;
			$this->payment_limit_date = $payment_limit_date;

			$this->sname = session_name();
			$this->sid = session_id();
			$this->__controller->redirectToURL('index.php?action=end_cvs&' . "{$this->sname}={$this->sid}");

			return false;
		}
		elseif ($row['payment'] == "�����ɷ�ѡʥڥ�������ȡ�") {
			//FunkyJam�إ᡼������
			$mailer->assign('admin', 1);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('shop/mail_paygent_card.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $subject, $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		elseif ($row['payment'] == "��ԥͥåȷ��") {
			//FunkyJam�إ᡼������
			//����ӥˡ�ATM����ԥͥåȤˤĤ��Ƥϡ���ͽ��פȤ��ơ�FJ�����Τ��롣
			$mailer->assign('admin', 0);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('shop/mail_paygent_net.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader($this->_subject . '��ͽ���'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_net.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_net.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_paygent_net.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();

			$this->clearProperties();
			$this->sname = session_name();
			$this->sid = session_id();
			$this->__controller->redirectToURL('index.php?action=end_net&' . "{$this->sname}={$this->sid}");

			return false;
		}
		elseif ($row['payment'] == "ATM���") {
			/*
			 * clearProperties��$this����Ȥ��ä���Τ��к��Ȥ���
			 * �̾���ѿ����������Ȥ���
			 */
			$pay_center_number = $this->pay_center_number;
			$customer_number = $this->customer_number;
			$conf_number = $this->conf_number;

			//����8����֤äƤ���Τǡ����դȤ���ɽ�������롣�������󤷤ʤ�����
			$payment_limit_date = $this->__limitDateFormat($this->payment_limit_date);
			$mailer->assign("payment_limit_date", $payment_limit_date);

			//FunkyJam�إ᡼������
			//����ӥˡ�ATM����ԥͥåȤˤĤ��Ƥϡ���ͽ��פȤ��ơ�FJ�����Τ��롣
			$mailer->assign('admin', 0);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('shop/mail_paygent_atm.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader($this->_subject . '��ͽ���'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_atm.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from FJSHOP.", $body, $system);
			}

			if ($this->mail) {
				//���Ҥ��ޤإ᡼������
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('shop/mail_paygent_atm.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//�ĥ������å��ο������ߤ����ä����
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//������Ҥإ᡼������
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('shop/mail_paygent_atm.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}

			/*
			 * apply_date�򹹿�����
			 */
			$db->begin();
			$db->statement('shop/sql/update_apply_date_order_desc.sql');
			$db->commit();

			$this->clearProperties();

			$this->sname = session_name();
			$this->sid = session_id();
			$this->pay_center_number = $pay_center_number;
			$this->customer_number = $customer_number;
			$this->conf_number = $conf_number;
			$this->payment_limit_date = $payment_limit_date;
			$this->__controller->redirectToURL('index.php?action=end_atm&' . "{$this->sname}={$this->sid}");

			return false;
		}
		else {
			return 'error';
		}
		
		$this->clearProperties();
		$this->__controller->redirectToAction('end');
		
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