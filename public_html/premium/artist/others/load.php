<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/PremiumAction.php');

class Action extends PremiumAction {
	function execute() {
		$this->user_end = "";
		$this->user_mail = "";
		$login_id = "";
		if(empty($_SESSION['login_id'])){
			$this->__controller->redirectToURL('/premium/login/');
		}
		else{
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
				$this->__controller->redirectToURL('/premium/login/');
			}
		}
		$path = '';
		if(isset($_GET['path'])) {
			$path = $_GET['path'];

			/*------------------------------------------------------------------------
			現在日付を取得
			------------------------------------------------------------------------*/
			 $today = getdate();
			 $today_minutes = $today['minutes'];
			 $today_hours = $today['hours'];
			 $today_month = $today['mon'];
			 $today_day = $today['mday'];
			 $today_year = $today['year'];
			 $now = mktime($today_hours, $today_minutes, 0, $today_month, $today_day, $today_year);

			/*------------------------------------------------------------------------
			切り替え日付を設定
			------------------------------------------------------------------------*/
			 $set_minutes1 = 0;
			 $set_hours1 = 12;
			 $set_month1 = 8;
			 $set_day1 = 30;
			 $set_year1 = 2014;
			 $change1 = mktime($set_hours1, $set_minutes1, 0, $set_month1, $set_day1, $set_year1);

			if($path == "mori/index"){
				if($now > $change1){
					$path = "mori2/index";
				}
			}
		} else {
			exit();
		}
		return $path;
	}
}
?>
