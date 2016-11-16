<?php
require_once(dirname(__FILE__) . '/confirm.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class ProcessAction extends Action {
	function execute() {
		foreach ($this->form['favorite'] as $key => $name) {
			$this->form[$key] = 1;
		}
		
		//one time password
		$this->form['password'] = substr(md5($this->account_no . $this->form['mail'] . time()), 0, 8);

		$result = $this->dbTable("magazine", null, null, sprintf("d_stamp IS NOT NULL AND mail='%s'", $this->form['mail']));
		if($result) {
			foreach($result as $row) {
				$this->account_no = $row['account_no'];
				$this->dbSingleExec('magazine/sql/optout.sql');
			}
		}
		$this->dbSingleExec('magazine/sql/insert.sql');

		$where = "mail='%s'";
		$result = $this->dbTable("magazine", null, null, sprintf($where, $this->form['mail']));
		if(!$result) {
			return 'input';
		} else {
			$result = $result[0];
			$this->account_no = $result['account_no'];
			$this->hash = $result['password'];

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
	}
}
?>