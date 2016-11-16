<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class Action extends DatabaseAction {
	function execute() {
		$this->hash = md5($this->account_no . $this->mail . $this->password);

		$m = parse_ini_file('mail.ini', true);
		$mail = new SimpleMail();

		$mail->setFrom($m['admin']['fromMail'],$m['admin']['fromName']);
		$mail->setSubject($m['admin']['subject']);
		$mail->setBody( dirname(__FILE__).'/mail.html' , $this->getProperties() );
			
//		$mail->setTo($m['admin']['toMail'],$m['admin']['toName']);		
//		$mail->send();
		
		$this->form = $result;
		$mail->setSubject($m['customer']['subject']);
		$mail->setTo($this->mail);
		$mail->send();

		$this->clearProperties();
		$this->__controller->redirectToAction('complete');

		return false;
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
		}

		if(!count($e)) {
			$result = $this->dbTable("magazine", null, null, "d_stamp is NULL and mail='{$f['mail']}'");
			if(!$result) {
				$e['mail'] = "メールアドレスに誤りがあります。";
			} else {
				$result = $result[0];
				$this->account_no = $result['account_no'];
				$this->mail = $result['mail'];
				$this->password = $result['password'];
			}
		}

		if(count($e)) {
			return 'input';
		}

		return true;
	}
}
?>