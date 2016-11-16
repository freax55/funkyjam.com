<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');

class Action extends DefaultAction {
	function execute() {
		if($this->old_page == 'bbcm_tkm091') {
			$this->__controller->redirectToURL('bbcm_tkm091/magazine.html');
		} elseif($this->old_page == 'bbcm_tkm092') {
			$this->__controller->redirectToURL('bbcm_tkm092/magazine.html');
		}
		return false;
	}
	
	function validate() {
		if(!$_SESSION["loginID"]['normal']) {
			return 'top';
		}

		return true;
	}
}
?>