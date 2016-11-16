<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();
		$this->__defaultAction = 'logout';
	}
}

$controller = new Controller();
$controller->run();
?>