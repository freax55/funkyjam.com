<?php
require_once('AbstractView.php');
require_once('Renderer.php');

class DefaultView extends AbstractView {
	function DefaultView(&$action) {
		$this->AbstractView($action);
	}
	
	function init() {
		AbstractView::init();
		
		$this->__prefix = '';
		$this->__suffix = '.html';
	}
	
	function fetch() {
		$this->__renderer = new Renderer();

		$this->assignProperties();

		$action = $this->__action;
		if (!$action->__module) {
			$action->__module = $action->__controller->__module;
		}
		if (!$action->__view) {
			$action->__view = $action->__controller->__action;
		}

		if (strpos($action->__view, '/') === 0) {
			$templateFile = $this->__prefix . substr($action->__view, 1) . $this->__suffix;
		}
		elseif ($action->__module) {
			$templateFile = $action->__module . '/' . $this->__prefix . $action->__view . $this->__suffix;
		}
		else {
			$templateFile = $this->__prefix . $action->__view . $this->__suffix;
		}
		$text = $this->__renderer->fetch($templateFile);
//	print($templateFile)	;
		return $text;
	}
	
	function display() {
		$text = $this->fetch();
		print($text);
	}

	/**
	* Assign properties to view.
	* @access public
	*/
	function assignProperties() {
		$hash = $this->__action;
		foreach ($hash as $key => $value) {
			if (!isset($value)) {
				continue;
			}

			if (preg_match('/^_.*/i', $key)) {
				continue;
			}

			$this->assignProperty($key, $value);
		}
	}

	/**
	* Assign property to view.
	* @access public
	*/
	function assignProperty($name, $value) {
		$this->__renderer->assign($name, $value);
	}
}
?>
