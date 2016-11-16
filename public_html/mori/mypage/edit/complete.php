<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function prepare() {
		$this->_subject = '「モリノナカマ」会員情報変更完了のお知らせ';
		$this->_system_name = 'モリノナカマ';
		$this->_system_mail = 'artist_mori@funkyjam.com';
		if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
			$this->_system_mail = 'artist_mori@funkyjam.com';
		}
		$this->confirm_mail = 'kida@evol-ni.com';
	}
	function execute() {
		parent::execute();

		//お客様の情報を更新
		$db =& $this->_db;
		$db->assign('id', $this->login_user_account_no);
		$db->assign('zip1', $this->zip1);
		$db->assign('zip2', $this->zip2);
		$db->assign('address1', $this->address1);
		$db->assign('address2', $this->address2);
		$db->assign('address3', $this->address3);
		$db->assign('tel', $this->tel);
		$db->assign('mail', $this->mail);
		$db->assign('password', $this->password);
		$db->statement('mori/mypage/edit/sql/mori_update_user.sql');
		$db->commit();


		//メール機動
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		$body = $mailer->fetch('mori/mypage/edit/mail/mori_update_user.html');
		$body = $this->convertEncodingBody($body);
		$body_system = $mailer->fetch('mori/mypage/edit/mail/mori_update_user_customer.html');
		$body_system = $this->convertEncodingBody($body_system);

		$mailer->assign('login_user_account_no', $this->login_user_account_no);

		$mailer->assign('password', $this->password);

		$mailer->assign('login_user_last_name', $this->login_user_last_name);
		$mailer->assign('login_user_first_name', $this->login_user_first_name);

		$mailer->assign('login_user_last_kana', $this->login_user_last_kana);
		$mailer->assign('login_user_first_kana', $this->login_user_first_kana);

		$mailer->assign('login_user_last_roman', $this->login_user_last_roman);
		$mailer->assign('login_user_first_roman', $this->login_user_first_roman);

		$mailer->assign('zip1', $this->zip1);
		$mailer->assign('zip2', $this->zip2);

		$mailer->assign('address1', $this->address1);
		$mailer->assign('address2', $this->address2);
		$mailer->assign('address3', $this->address3);

		$mailer->assign('tel', $this->tel);

		$mailer->assign('mail', $this->mail);

		$mailer->assign('login_user_sex', $this->login_user_sex);

		$mailer->assign('login_user_birth_year', $this->login_user_birth_year);
		$mailer->assign('login_user_birth_month', $this->login_user_birth_month);
		$mailer->assign('login_user_birth_day', $this->login_user_birth_day);


		//お客さまへメール送信はしない
		//$customer = $this->mail;
		//$this->send($customer, $subject, $body, $system);

		//FJにメール送信
		$this->send($system, $this->convertEncodingHeader('【'. $this->login_user_last_name.' '.$this->login_user_first_name.'　様の'.$this->_subject . '】'), $body_system, $customer);

		//エボルニにメール送信
		$this->send($this->confirm_mail, $this->convertEncodingHeader('Send to confirmer from evolni【'. $this->login_user_last_name.' '.$this->login_user_first_name.'　様の'.$this->_subject . '】'), $body_system, $system);

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