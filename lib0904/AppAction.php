<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class AppAction extends DatabaseAction {
	function AppAction(&$controller) {
		$this->DatabaseAction($controller);
	}

}
?>