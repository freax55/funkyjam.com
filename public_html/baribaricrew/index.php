<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();

		$this->__defaultAction = 'add';
	}
}

$controller = new Controller();
$controller->run();
?>