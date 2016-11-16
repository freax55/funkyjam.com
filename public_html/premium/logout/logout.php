<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/publisherCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$_SESSION['login_id'] = "";
		$this->clearProperties();
		$this->__controller->redirectToURL('/premium/');
	}
}
?>