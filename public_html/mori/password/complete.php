<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function prepare() {
		$this->_subject = '「モリノナカマ」パスワード再発行のお知らせ';
		$this->_system_name = 'モリノナカマ';
		$this->_system_mail = 'artist_mori@funkyjam.com';
		if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
			$this->_system_mail = 'artist_mori@funkyjam.com';
		}
		$this->confirm_mail = 'kida@evol-ni.com';
	}
	function execute() {
		parent::execute();

		//ランダムパスワード作成
		$seed = "123456789abcdefghjikmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXY";
		do {
			$password = "";
			for ($i = 0; $i < 8; $i++) {
				$password .= substr($seed, rand(0, strlen($seed) - 1), 1);
			}
		} while (!ereg("[0-9]", $password) || !ereg("[a-z]", $password) || !ereg("[A-Z]", $password));
		$this->password = $password;

		//メール機動
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		$body = $mailer->fetch('mori/password/mail/mori_password.html');
		$body = $this->convertEncodingBody($body);
		$body_system = $mailer->fetch('mori/password/mail/mori_password_customer.html');
		$body_system = $this->convertEncodingBody($body_system);
		$mailer->assign('last_name', $this->last_name);
		$mailer->assign('first_name', $this->first_name);
		$mailer->assign('password', $this->password);

		//お客さまへメール送信＋更新処理
		$customer = $this->mail;
		$this->send($customer, $subject, $body, $system);
		$db =& $this->_db;
		$db->assign('id', $this->login_id);
		$db->assign('password', $this->password);
		$db->statement('mori/password/sql/mori_update_password.sql');
		$db->commit();

		//FJにメール送信
		$this->send($system, $this->convertEncodingHeader('【'. $this->last_name.' '.$this->first_name.'　様の'.$this->_subject . '】'), $body_system, $customer);

		//エボルニにメール送信
		$this->send($this->confirm_mail, $this->convertEncodingHeader('Send to confirmer from evolni【'. $this->last_name.' '.$this->first_name.'　様の'.$this->_subject . '】'), $body_system, $system);
		$this->clearProperties();
		$this->__controller->redirectToAction('end');
		return false;
	}
	function validate() {
		$this->errors = array();

		if(empty($this->last_name)){
			$this->errors['name'] = "入力してください。";
		}
		if(empty($this->first_name)){
			$this->errors['name'] = "入力してください。";
		}

		if (!$this->mail) {
			$this->errors['mail'] = '入力してください。';
		}elseif (!$this->isMail($this->mail)) {
			$this->errors['mail'] = '形式が正しくありません。';
		}
		elseif ($this->mail != $this->confirm ) {
			$this->errors['mail'] = '確認入力と一致していません。';
		}

		$key = "login_id";
		if (empty($this->$key)) {
			$this->errors[$key] = '入力してください。';
		}

		if (!count($this->errors)) {
			$db =& $this->_db;
			$result = $db->statement('mori/password/sql/mori_password.sql');
			$list = $db->buildTree($result);
					
			function array_flattent($item,$key,$ret){
			if(is_array($item)) array_walk($item,"array_flattent",&$ret);
				else $ret[]=$item;
			}
			array_walk($tree,"array_flattent",&$new_arr);
			$Coincidence = 0;
			if($list){
				foreach ($list as $value) {
					if($value[last_name] == $this->last_name && $value[first_name] == $this->first_name && $value[mail] == $this->mail && $value[account_no	] == $this->login_id){
						$Coincidence = 1;
					}
				}
			}
			if($Coincidence == 0){
				$this->errors['all'] = 'ご登録情報を確認できませんでした。';
			}
		}

		if (count($this->errors)) {
			return 'password';
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