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
		
		$this->_url = 'pgsql://funkyjam:funkyjam@localhost:5432/fj_db';
	}


	/**
	 * Util
	 */
	function dbTable($table,$key=null,$order=null,$where=null,$select=null){
		$db =& $this->_db;
		$sql ="select";
		if(empty($select))
			$sql .= " *";
		else
			$sql .= " " . $select;
		$sql .= " from ". $table;
		if (!empty($where))
			$sql .= " where ".$where;
		if(!empty($order))
			$sql .= " order by ".$order;

		$db->assign($this->getProperties());
		$result = $db->query($sql);
		if(count($result))
			return $db->buildTree($result, $key);
		else
			return array();
	}
	function dbQuery($sql,$key=null){
		$db =& $this->_db;
		$db->assign($this->getProperties());
		$result = $db->query($sql);
		if(count($result))
			return $db->buildTree($result, $key);
		else
			return array();
	}
	function dbTree($path,$key = null){
		$db =& $this->_db;
		$db->assign($this->getProperties());
		$result = $db->statement($path);
		if(count($result))
			return $db->buildTree($result, $key);
		else
			return array();
	}
	function dbRow($path){
		$db =& $this->_db;
		$db->assign($this->getProperties());
		$result = $db->statement($path);
		if($row = $db->fetch_assoc($result))
			return $row;
		else
			return array();
	}
	function dbValue($path,$key){
		$row = $this->dbRow($path);
		if(count($row))
			return $row[$key];
		else
			return false;
	}
	function dbSingleExec($path){
		$this->dbBigen();
		$rs = $this->dbExec($path);
		$this->dbCommit();
		return $rs;
	}
	function dbExec($path){
		$db =& $this->_db;
		$db->assign($this->getProperties());
		return $db->statement($path);
	}
	function dbBigen(){
		$db =& $this->_db;
		$db->begin();
	}
	function dbCommit(){
		$db =& $this->_db;
		$db->commit();
	}
	
}
?>