<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function prepare() {
		$this->_subject = '森大輔オフィシャルファンクラブ「モリノナカマ」退会のお知らせ';
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
		$db->assign('reason', "自主退会");
		$db->statement('mori/mypage/delete/sql/mori_delete_user.sql');
		$db->commit();


		//メール機動
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

		//お客さまへメール送信
		$customer = $this->mail;
		$this->send($customer, $subject, $body, $system);

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