<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$this->param = "";
		if($this->login_flg == 'login_ON'){
			$this->param = "login";
		}
		else{
			$this->param = "out";
		}
		$path = '';
		if(isset($_GET['path'])) {
			$path = $_GET['path'];
		} else {
			exit();
		}
		return $path;
	}
}
?>