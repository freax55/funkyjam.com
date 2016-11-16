<?php
require_once(dirname(__FILE__) . '/confirm.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class ProcessAction extends Action {
	function execute() {
		//Mail Magazine Quick Entry
		if ($this->form['magazine']) {
			$result = $this->dbTable("magazine", null, null, sprintf("d_stamp is null and mail='%s'", $this->form['mail']), "mail");
			if(!$result) {
				$this->dbExec('magazine/sql/quick.sql');
			}
		}

		$m = parse_ini_file(dirname(__FILE__).'/mail.ini', true);
		$mail = new SimpleMail();

		$subject = $m['admin']['subject'];
		if($this->form['answer1'] == 'クラブ' && $this->form['answer2'] == 'A') {
			$subject .= '：正解';
		}
		
		$mail->setFrom($this->form['mail'], $this->form['name']);
		$mail->setSubject($subject);
		$mail->setBody(dirname(__FILE__) . '/mail.html', $this->getProperties());
		
		$mail->setTo($m['admin']['toMail'], $m['admin']['toName']);
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