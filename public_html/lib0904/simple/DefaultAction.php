<?php
require_once('AbstractAction.php');

class DefaultAction extends AbstractAction {
	function DefaultAction(&$controller) {
		$this->AbstractAction($controller);
	}

	function isMail($value) {
		return $this->isKetaiMail($value);
	}

	function init() {
		AbstractAction::init();
	}
	
	function prepare() {
	}

	function execute() {
		return null;
	}
	
	function error(&$condition) {
		if ($condition) {
			return $condition;
		}
		else {
			$this->__controller->redirectToAction($this->__controller->__defaultAction);
			return false;
		}
	}

	function dispose() {
	}

	function validate() {
		return true;
	}

	function decision($condition) {
		if ($condition === true) {
			return true;
		}
		else {
			return false;
		}
	}
}
?>