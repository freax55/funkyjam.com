<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');

class Action extends DefaultAction {
	function validate() {
		if(!$_SESSION["loginID"]['normal']) {
			$this->__controller->redirectToURL('/artist/kubota/login/');
			exit();
		}

		return true;
	}
}
?>