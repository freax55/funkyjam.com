<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class Action extends DatabaseAction {
	function execute() {
		foreach ($this->form['favorite'] as $key => $name) {
			$this->form[$key] = 1;
		}
		
		$this->dbSingleExec('magazine/sql/update.sql');

		$m = parse_ini_file('mail.ini', true);
		$mail = new SimpleMail();

		$mail->setFrom($m['admin']['fromMail'],$m['admin']['fromName']);
		$mail->setSubject($m['admin']['subject']);
		$mail->setBody( dirname(__FILE__).'/mail.html' , $this->getProperties() );
		
//		$mail->setTo($m['admin']['toMail'],$m['admin']['toName']);		
//		$mail->send();
		
		$mail->setSubject($m['customer']['subject']);
		$mail->setTo($this->form['mail']);
		$mail->send();

		$this->clearProperties();
		$this->__controller->redirectToAction('complete');
		
		return false;
	}

	function validate() {
		return true;
		
	}
}
?>