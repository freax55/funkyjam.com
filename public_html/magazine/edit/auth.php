<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class Action extends DatabaseAction {
	
	function execute() {
		$result = $this->dbTable("magazine", null, null, sprintf("d_stamp is NULL and account_no=%d", $this->a));
		if($result) {
			$result = $result[0];

			$hash = $result['password'];

			if ($hash == $this->t) {
				$this->account_no = $result['account_no'];

				$this->__controller->redirectToAction('input');
		
				return false;
			}
		}

		$this->clearProperties();
		$this->__controller->redirectToURL('/magazine/change/');
	
		return false;
	}
}
?>