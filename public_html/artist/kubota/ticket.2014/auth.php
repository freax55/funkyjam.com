<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class AuthAction extends DatabaseAction {
	function init() {
		parent::init();

		if(!$_SESSION["loginID"]['ticket']) {
			unset($_SESSION["loginID"]);
			$this->__controller->redirectToURL('/artist/kubota/login_tour/');
			exit();
		}
		if($_SESSION["loginID"]['ticket'] != "KMKT1209") {
			unset($_SESSION["loginID"]);
			$this->__controller->redirectToURL('/artist/kubota/login_tour/');
			exit();
		}
	}
}
?>