<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');

class Action extends DefaultAction {
	function execute() {
		$this->sname = session_name();
		$this->sid = session_id();
	}
}
?>
