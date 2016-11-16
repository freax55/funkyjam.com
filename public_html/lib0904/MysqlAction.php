<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/Config.php');

class MysqlAction extends DefaultAction {
	var $_url = null;
	var $_db = null;
	var $_conf = null;
	
	function MysqlAction(&$controller) {
		$this->DefaultAction($controller);
		
		$this->_db = new Database($this->_url);
		$this->_db->connect();
	}
	
	function init() {
		DefaultAction::init();
		
		$this->_conf = new Config();
		$conf = $this->_conf;
		$this->_url = $conf->dbUrl;
	}
}
?>