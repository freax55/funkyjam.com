<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$this->param = "";
		if($this->login_flg == 'login_ON'){
			//終了時刻を正規化して、ひと月前に設定
			$updateTime = strtotime($this->login_user_end_stamp);
			$updateTimeStart = mktime(0, 0, 0, date("m", strtotime("-1 month" , $updateTime)), date("d", strtotime("-1 month" , $updateTime)), date("Y", strtotime("-1 month" , $updateTime)));

			//現在時刻を取得
			$updateTimeNow = mktime(0, 0, 0, date("n"), date("d"), date("Y"));

			//現在時刻よりも終了時刻ひと月前が過ぎていれば、ok
			if($updateTimeNow >= $updateTimeStart){
				$this->param = "login";
			}else{
				$this->param = "notTime";
			}
		}
		else{
			$this->param = "out";
		}
	}
}
?>