<?php
require_once('DatabaseAction.php');

class CommonAction extends DatabaseAction {
	function execute() {
		$this->user_end = "";
		$this->user_mail = ""; 
		$this->login_flg = "";
		if(!empty($_SESSION['login_id'])){
			$this->login_flg = "login_ON";
			$login_id = $_SESSION['login_id'];
			$db =& $this->_db;
			$db->assign('login_id', $login_id);

			$result = $db->statement($_SERVER['DOCUMENT_ROOT'].'/premium/sql/login_user.sql');
			$user_end = $db->buildTree($result);
			if(!empty($user_end)){
				$this->user_end = $user_end['0']['end_stamp'];
				$user_mail = strtotime($user_end['0']['mail_stamp']);
				$now_time = strtotime("now");
				if($now_time > $user_mail){
					$this->user_mail = "まもなく有効期限が切れます";
				}
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