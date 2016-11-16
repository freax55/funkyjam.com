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
		$this->_subject = '【FJ PREMIUM】ID変更完了のお知らせ';
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
		$body = $mailer->fetch('premium/reminder/mail_id_remind.html');
		$body = $this->convertEncodingBody($body);

		//お客様にメール送信
		$customer = $this->new_id;
		$this->send($customer, $subject, $body, $system);

		$db =& $this->_db;
		$db->assign('id', $this->insert_id);
		$db->assign('mail', $this->new_id);
		$db->statement('premium/reminder/sql/update_premium.sql');
		$db->commit();

		//FJにメール送信
		$this->send($system, $subject, $body, $customer);

		//エボルニにメール送信
		$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);

		$_SESSION['login_id'] = NULL;
		unset($this->login_flg);
		$this->clearProperties();
		$this->__controller->redirectToAction('id_remind_complete');
	}
	function validate() {
		$this->errors = array();
		
		$db =& $this->_db;
		$result = $db->statement('premium/reminder/sql/insert_list.sql');
		$tree = $db->buildTree($result);
				
		function array_flattent($item,$key,$ret){
		if(is_array($item)) array_walk($item,"array_flattent",&$ret);
			else $ret[]=$item;
		}
		array_walk($tree,"array_flattent",&$new_arr);

		if (!$this->new_id) {
			$this->errors['new_id'] = 'IDを入力してください。';
		}elseif (!$this->isMail($this->new_id)) {
			$this->errors['new_id'] = 'IDの形式が正しくありません。';
		}elseif ($this->new_id != $this->new_conf ) {
			$this->errors['new_id'] = '確認入力と一致しません。';
		}elseif (in_array($this->new_id, $new_arr)) {
			$this->errors['new_id'] = 'こちらのメールアドレスは使用できません';
		}
		if (count($this->errors)) {
			return 'id_remind_confirm';
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