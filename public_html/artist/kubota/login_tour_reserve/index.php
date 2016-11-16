<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

//ini_set('display_errors','on');
//error_reporting(E_ALL);

class Controller extends DefaultController {
	function init() {
		parent::init();

		$this->__defaultAction = 'top';
	}
}

$controller = new Controller();
$controller->run();
?>