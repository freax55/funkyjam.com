<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');

class AppAction extends DatabaseAction {
	function AppAction(&$controller) {
		$this->DefaultAction($controller);
	}

}
?>