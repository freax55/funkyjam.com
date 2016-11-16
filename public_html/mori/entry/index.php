<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();
		//文字コード差し替え処理
		$this->code = 'euc';
		$this->__defaultAction = 'add';
	}
}

$controller = new Controller();
$controller->run();
?>