<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();
		//文字コード差し替え処理
		$this->code = 'jis';
		$ip = $_SERVER["REMOTE_ADDR"];
		if($ip == '182.171.234.187'){
			$this->__defaultAction = 'top';
		}else{
			$this->__defaultAction = 'top';
		}
	}
}

$controller = new Controller();
$controller->run();
?>
