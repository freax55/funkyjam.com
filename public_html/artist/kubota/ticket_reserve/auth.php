<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class AuthAction extends DatabaseAction {
	function init() {
		parent::init();

		if(!$_SESSION["loginID"]['ticket']) {
			unset($_SESSION["loginID"]);
			$this->__controller->redirectToURL('/artist/kubota/login_tour_reserve/');
			exit();
		}
		if($_SESSION["loginID"]['ticket'] != "CKDL0110") {
			unset($_SESSION["loginID"]);
			$this->__controller->redirectToURL('/artist/kubota/login_tour_reserve/');
			exit();
		}
	}
}
?>