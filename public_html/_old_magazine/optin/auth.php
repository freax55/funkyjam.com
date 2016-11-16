<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class Action extends DatabaseAction {
	
	function execute() {
		$result = $this->dbTable("magazine", null, null, sprintf("d_stamp is not NULL and account_no=%d", $this->a));
		if($result) {
			$result = $result[0];

			$hash = md5($result['account_no'] . $result['mail'] . $result['password']);

			if ($hash == $this->t) {
				$db =& $this->_db;
				$db->assign('account_no', $result['account_no']);
				$this->dbSingleExec('magazine/sql/optin.sql');

				$m = parse_ini_file('mail.ini', true);
				$mail = new SimpleMail();
		
				$mail->setFrom($m['admin']['fromMail'],$m['admin']['fromName']);
				$mail->setSubject($m['admin']['subject']);
				$mail->setBody( dirname(__FILE__).'/mail.html' , $this->getProperties() );
				
//				$mail->setTo($m['admin']['toMail'],$m['admin']['toName']);		
//				$mail->send();
				
				$this->form = $result;
				$mail->setSubject($m['customer']['subject']);
				$mail->setTo($this->form['mail']);
				$mail->send();

				$this->clearProperties();
				$this->__controller->redirectToAction('complete');
		
				return false;
			}
		}

		$this->clearProperties();
		$this->__controller->redirectToURL('/magazine/entry/');
	
		return false;
	}
}
?>