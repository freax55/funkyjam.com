<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();

		$this->__defaultAction = 'process';
	}
}

$controller = new Controller();
$controller->run();
?>