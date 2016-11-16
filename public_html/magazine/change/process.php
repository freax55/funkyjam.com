<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class Action extends DatabaseAction {
	function prepare() {
		$this->errors = null;
		
		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'empS' => '選択をお願いします。',
			'cmp' => '確認入力と一致していません。入力をご確認ください。',
			'fom' => '形式をご確認ください。'
		);
		
		$key = 'favorite';
		$this->form[$key] = array();
		$pattern = '/^fav_.+$/';
		foreach (array_keys($this->form) as $name) {
			if(preg_match($pattern, $name) && $this->form[$name]){
				$this->form[$key][$name] = $this->form[$name];
			}
		}
	}

	function validate() {
		$d =& $this->defaultMessages;
		$this->errors = array();	
		$e =& $this->errors;
		$f =& $this->form;
		
		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
		}elseif($this->login_mail != $f['mail']){
			$result = $this->dbTable("magazine", null, null, "d_stamp IS NULL AND mail='{$f['mail']}'", "mail");
			if(!$result) {
				$e[$key] = "入力されたメールアドレスはご使用いただけません。";
			}
		}

		if(count($e)) {
			return 'input';
		}

		return true;
	}

	function execute() {
		$result = $this->dbTable("magazine", null, null, sprintf("d_stamp is NULL and mail='%s'", $this->form['mail']));

		if($result) {
			$result = $result[0];

			$this->account_no = $result['account_no'];

			//one time password
			$this->hash = substr(md5($this->account_no . $this->result['mail'] . time()), 0, 8);

			$this->dbSingleExec('magazine/sql/set_password.sql');
	

			$m = parse_ini_file('mail.ini', true);
			$mail = new SimpleMail();
	
			$mail->setFrom($m['admin']['fromMail'],$m['admin']['fromName']);
			$mail->setSubject($m['admin']['subject']);
			$mail->setBody( dirname(__FILE__).'/mail.html' , $this->getProperties(),'UTF-8' );
			
//			$mail->setTo($m['admin']['toMail'],$m['admin']['toName']);		
//			$mail->send();
			
			$mail->setSubject($m['customer']['subject']);
			$mail->setTo($this->form['mail']);
			$mail->send();
	
			$this->clearProperties();
			$this->__controller->redirectToAction('complete');
			
			return false;
		}

		$this->clearProperties();
		$this->__controller->redirectToURL('/magazine/change/');
	
		return false;
	}
}
?>