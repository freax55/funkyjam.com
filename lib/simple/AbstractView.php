<?php
require_once('Debug.php');

class AbstractView extends Debug {
	var $__prefix = null;
	var $__suffix = null;
	var $__action = null;
	var $__renderer = null;
	
	function AbstractView(&$action) {
		$this->__action =& $action;
		$this->Debug();
	}
	
	/**
	* Fetch view.
	* @access public
	* @return string
	*/
	function fetch() {
		//Please implement.
	}

	/**
	* Display view.
	* @access public
	*/
	function display() {
		//Please implement.
	}
}
?>
