<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();
		//文字コード差し替え処理
		$this->code = 'jis';
		$this->__defaultAction = 'login';
	}
}

$controller = new Controller();
$controller->run();
?>