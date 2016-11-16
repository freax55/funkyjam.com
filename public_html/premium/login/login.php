<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/publisherCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		if($this->login_flg == "login_ON"){
			$this->__controller->redirectToURL('/premium/');
		}
	}
}
?>