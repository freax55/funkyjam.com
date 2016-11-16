<?php
require_once(dirname(__FILE__) . '/confirm.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class ProcessAction extends ConfirmAction {
	function execute() {
		$this->dbSingleExec('beatconnection/sql/insert.sql');

		$m = parse_ini_file('mail.ini', true);
		$mail = new SimpleMail();

		$mail->setFrom($m['admin']['fromMail'],$m['admin']['fromName']);
		$mail->setSubject($m['admin']['subject']);
		$mail->setBody( dirname(__FILE__).'/mail.html' , $this->getProperties() );
		
		$mail->setTo($m['admin']['toMail']);
		$mail->send();
		
		$mail->setSubject($m['customer']['subject']);
		$mail->setTo($this->form['mail']);
		$mail->send();
		
		$this->clearProperties();
		$this->__controller->redirectToAction('complete');
		
		return false;
	}
}
?>