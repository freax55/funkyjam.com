<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/DefaultAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Database.php');

class DatabaseAction extends DefaultAction {
	var $_url = null;
	var $_db = null;
	
	function DatabaseAction(&$controller) {
		$this->DefaultAction($controller);

		$this->_db = new Database($this->_url);
		$this->_db->connect();
	}
	
	function init() {
		DefaultAction::init();
		
		$this->_url = 'pgsql://funkyjam:Wi2Mi9gm@localhost:5432/fj_db_test';
	}
}
?>