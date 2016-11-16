<?php
require_once('auth.php');

class ticketAction extends AuthAction {
	function execute() {
		$db =& $this->_db;
		
		$result = $db->statement('artist/kubota/ticket/sql/list.sql');
		$tree = $db->buildTree($result, array('area', 'item_code'));
		$this->list = $tree;

//		$this->var_dump($tree);

		$this->carriage = 400;
	}
}
?>