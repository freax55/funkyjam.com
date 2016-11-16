<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');

class Action extends DatabaseAction {

	function execute() {
		$this->clearProperties();
		$this->__controller->redirectToAction('end');
		
		return false;
	}
}
?>