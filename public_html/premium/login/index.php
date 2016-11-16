<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();

		$this->__defaultAction = 'login';
	}
}

$controller = new Controller();
$controller->run();
?>