<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');

class Action extends DefaultAction {
	function validate() {
		if(!$_SESSION["loginID"]['backstage_2015']) {
			$this->__controller->redirectToURL('../');
			exit();
		}

		return true;
	}
}
?>