<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/publisherCommon.php');

//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}

	function prepare() {
		$this->_subject = '【FJ PREMIUM】パスワード変更完了のお知らせ';
		$this->_system_name = 'FJプレミアムページ';
		$this->_system_mail = 'premium@funkyjam.com';
		$this->_other_mail = 'premium@funkyjam.com';
		$this->_other_mail_code = 'A013';
		$this->confirm_mail = 'kida@evol-ni.com';
	}

	function execute() {
		parent::execute();

		//メール機動
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		$body = $mailer->fetch('premium/reminder/mail_pass_edit.html');
		$body = $this->convertEncodingBody($body);

		//お客様にメール送信
		$customer = $this->login_id;
		$this->send($customer, $subject, $body, $system);

		$db =& $this->_db;
		$db->assign('id', $this->insert_id);
		$db->assign('pass', $this->new_pass);
		$db->statement('premium/reminder/sql/update_premium_pass_edit.sql');
		$db->commit();

		//FJにメール送信
		$this->send($system, $subject, $body, $customer);

		//エボルニにメール送信
		$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);

		$_SESSION['login_id'] = NULL;
		unset($this->login_flg);
		$this->clearProperties();
		$this->__controller->redirectToAction('pass_edit_complete');
	}
	function validate() {
		$this->errors = array();

		$this->new_pass = str_replace(array(" ","　"), "", $this->new_pass);
		if (empty($this->new_pass)) {
			$this->errors['new_pass'] = '入力してください。';
		}elseif(!$this->isId($this->new_pass) || mb_strlen($this->new_pass) != 8) {
			$this->errors['new_pass'] = '半角英数字8桁で入力してください';
		}elseif ($this->new_pass != $this->new_conf ) {
			$this->errors['new_pass'] = '確認入力と一致しません。';
		}
		if (count($this->errors)) {
			return 'pass_edit_confirm';
		}

		return true;
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