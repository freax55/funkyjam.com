<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$_SESSION['login_id'] = "";
		$nowuser = "";
		$this->clearProperties();
		$this->__controller->redirectToURL('/mori/');
	}
}
?>