<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		DefaultController::init();
		
		$this->__defaultAction = 'load';
		$this->__defaultActionFile = $_SERVER['DOCUMENT_ROOT'] . '/../lib0904/PremiumAction.php';
		$this->__defaultActionClass = 'PremiumAction';
				
		//$this->__viewFile = $_SERVER['DOCUMENT_ROOT'] . '/../lib0904/PremiumView.php';
		//$this->__viewClass = 'PremiumView';
	}
}
$controller = new Controller();
$controller->run();
?>