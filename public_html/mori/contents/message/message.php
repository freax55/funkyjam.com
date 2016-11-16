<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$this->param = "";
		if($this->login_flg == 'login_ON'){
			//今日が誕生日を過ぎていて１ヶ月以上経過していない場合
			$today = mktime(0, 0, 0, date("n"), date("j"), date("Y"));
			$birth = mktime(0, 0, 0, $this->login_user_birth_month, $this->login_user_birth_day, date("Y"));
			$end = mktime(0, 0, 0, $this->login_user_birth_month+1, $this->login_user_birth_day, date("Y"));
			if($today >= $birth && $today <= $end){
				$this->param = "login";
			}
			else{
				$this->param = "out";
			}
		}
	}
}
?>