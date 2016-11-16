<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$this->param = "";

		if($this->login_flg == 'login_ON'){
			$this->param = "login";
			$this->yearList = array();
			$now = date("Y");
			$start = $now-100;
			for($i = $start; $i<= $now; $i++){
				$this->yearList[] = $i;
			}

			if(!$this->reset){

				$this->zip1 = $this->login_user_zip1;
				$this->zip2 = $this->login_user_zip2;

				$this->address1 = $this->login_user_address1;
				$this->address2 = $this->login_user_address2;
				$this->address3 = $this->login_user_address3;

				$this->tel = $this->login_user_tel;

				$this->mail = $this->login_user_mail;
				$this->confirm = $this->login_user_mail;

				$this->password = $this->login_user_pass;

			}


		}
		else{
			$this->param = "out";
		}
	}
}
?>