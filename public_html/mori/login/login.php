<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$this->param = "";
		//遷移先表示
		$this->before = $_SERVER['HTTP_REFERER'];
		if($this->login_flg == 'login_ON'){
			$this->param = "login";
		}
	}
}
?>