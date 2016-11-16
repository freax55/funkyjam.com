<?php
// ini_set('display_errors','on');
// error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		parent::init();
//phpinfo();
		$this->__defaultAction = 'input';
		$this->__defaultActionFile = $_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php';
		$this->__defaultActionClass = 'DefaultAction';
	}
}

$controller = new Controller();
$controller->run();
?>
