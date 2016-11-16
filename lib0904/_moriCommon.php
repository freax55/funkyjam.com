<?php
require_once('DatabaseAction.php');

class CommonAction extends DatabaseAction {
	function execute() {
		
		$this->login_flg = "";
		if(!empty($_SESSION['login_id'])){
			$this->login_flg = "login_ON";
			$login_id = $_SESSION['login_id'];
			$db =& $this->_db;
			$db->assign('login_id', $login_id);
			$result = $db->statement($_SERVER['DOCUMENT_ROOT'].'/mori/sql/mori_login_user.sql');
			$nowuser = $db->buildTree($result);
			if(!empty($nowuser)){
				$this->login_user_account_no = $nowuser['0']['account_no'];

				$this->login_user_first_name = $nowuser['0']['first_name'];
				$this->login_user_last_name = $nowuser['0']['last_name'];

				$this->login_user_first_kana = $nowuser['0']['first_kana'];
				$this->login_user_last_kana = $nowuser['0']['last_kana'];

				$this->login_user_first_roman = $nowuser['0']['first_roman'];
				$this->login_user_last_roman = $nowuser['0']['last_roman'];

				$this->login_user_zip1 = $nowuser['0']['zip1'];
				$this->login_user_zip2 = $nowuser['0']['zip2'];

				$this->login_user_address1 = $nowuser['0']['address1'];
				$this->login_user_address2 = $nowuser['0']['address2'];
				$this->login_user_address3 = $nowuser['0']['address3'];

				$this->login_user_tel = $nowuser['0']['tel'];

				$this->login_user_mail = $nowuser['0']['mail'];

				$this->login_user_sex = $nowuser['0']['sex'];

				$this->login_user_birth_year = $nowuser['0']['birth_year'];
				$this->login_user_birth_month = $nowuser['0']['birth_month'];
				$this->login_user_birth_day = $nowuser['0']['birth_day'];

				$this->login_user_end_stamp = $nowuser['0']['end_stamp'];

				$this->login_user_payment = $nowuser['0']['payment'];

				$this->login_user_pass = $nowuser['0']['pass'];
			}
			else{
				$this->login_flg = "login_OFF";
			}
		}
		else{
			$this->login_flg = "login_OFF";
		}
	}
}
?>