<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function prepare() {
		$this->_subject = '�����奪�ե������ե��󥯥�֥֡��Υʥ��ޡ����Τ��Τ餻';
		$this->_system_name = '���Υʥ���';
		$this->_system_mail = 'artist_mori@funkyjam.com';
		if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
			$this->_system_mail = 'artist_mori@funkyjam.com';
		}
		$this->confirm_mail = 'kida@evol-ni.com';
	}
	function execute() {
		parent::execute();

		//�����ͤξ���򹹿�
		$db =& $this->_db;
		$db->assign('id', $this->login_user_account_no);
		$db->assign('reason', "�������");
		$db->statement('mori/mypage/delete/sql/mori_delete_user.sql');
		$db->commit();


		//�᡼�뵡ư
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		$body = $mailer->fetch('mori/mypage/delete/mail/mori_delete_user.html');
		$body = $this->convertEncodingBody($body);
		$body_system = $mailer->fetch('mori/mypage/delete/mail/mori_delete_user_customer.html');
		$body_system = $this->convertEncodingBody($body_system);

		$mailer->assign('login_user_account_no', $this->login_user_account_no);

		$mailer->assign('password', $this->password);

		$mailer->assign('login_user_last_name', $this->login_user_last_name);
		$mailer->assign('login_user_first_name', $this->login_user_first_name);

		//���Ҥ��ޤإ᡼������
		$customer = $this->mail;
		$this->send($customer, $subject, $body, $system);

		//FJ�˥᡼������
		$this->send($system, $this->convertEncodingHeader('��'. $this->login_user_last_name.' '.$this->login_user_first_name.'���ͤ�'.$this->_subject . '��'), $body_system, $customer);

		//���ܥ�ˤ˥᡼������
		$this->send($this->confirm_mail, $this->convertEncodingHeader('Send to confirmer from evolni��'. $this->login_user_last_name.' '.$this->login_user_first_name.'���ͤ�'.$this->_subject . '��'), $body_system, $system);

		$_SESSION['login_id'] = "";
		$nowuser = "";
		$this->clearProperties();
		$this->__controller->redirectToAction('end');
		return false;
	}
	function convertEncodingBody($str, $enc = 'SJIS') {
		$str = mb_convert_encoding($str, 'JIS', $enc);

		return $str;
	}
	function convertEncodingHeader($str, $enc = 'EUC-JP') {
		$str = $this->convertEncodingBody($str, $enc);
		$str = '=?iso-2022-jp?B?' . base64_encode($str) . '?=';

		return $str;
	}
	function send($to, $subject, $body, $from) {
		mail($to, $subject, $body, "From: " . $from);
	}
}
?>