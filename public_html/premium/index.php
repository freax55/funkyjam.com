<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();

		/*------------------------------------------------------------------------
		現在日付を取得
		------------------------------------------------------------------------*/
/*		$today = getdate();
		$today_month = $today['mon'];
		$today_day = $today['mday'];
		$today_year = $today['year'];
		$now = mktime(0, 0, 0, $today_month, $today_day, $today_year);
*/
		/*------------------------------------------------------------------------
		切り替え日付を設定
		------------------------------------------------------------------------*/
/*		$set_month1 = 1;
		$set_day1 = 1;
		$set_year1 = 2016;
		$change1 = mktime(0, 0, 0, $set_month1, $set_day1, $set_year1);
*/
		/*------------------------------------------------------------------------
		切り替え日付を設定
		------------------------------------------------------------------------*/
/*
		$viewArea = "";
		$ip = $_SERVER["REMOTE_ADDR"];
		if($ip == '182.171.234.187'){
			$viewArea = "evol-ni";
		}


		if($now >= $change1){
			$this->__defaultAction = 'top_20160101';
		}else{
			$this->__defaultAction = 'top';
		}
*/
		$this->__defaultAction = 'top';

	}
}

$controller = new Controller();
$controller->run();
?>