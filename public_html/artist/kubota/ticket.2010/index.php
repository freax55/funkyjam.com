<?php
//ini_set('display_errors','on');
//error_reporting(E_ALL^E_NOTICE);

ini_set('mbstring.internal_encoding', 'EUC-JP');

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

class Controller extends DefaultController {
	function init() {
		parent::init();

		$this->__defaultAction = 'list';
	}

	function getActionClass() {
		$this->requireActionFile();

		$type1 = ucfirst($this->__action) . 'Action';
		$type2 = ucfirst($this->__action);

		if (class_exists('ticketAction')) {
			return 'ticketAction';
		}
		elseif (class_exists($type1)) {
			return $type1;
		}
		elseif (class_exists($type2)) {
			return $type2;
		}
		elseif (class_exists('Action')) {
			return 'Action';
		}
		else {
			return $this->__defaultActionClass;
		}
	}
}

$controller = new Controller();
$controller->run();
?>