<?php
require_once('auth.php');

class Action extends AuthAction {
	function prepare() {
		parent::prepare();
		
		if ($this->item_code) {
			$this->item_code = null;
		}
		
		$this->toursaleList = $this->dbTable('toursale', 'password', null, "start_date <= current_timestamp AND end_date >= current_timestamp", "id, password, start_date, end_date, payment_end_date");
	}
		
	function execute() {
		$db =& $this->_db;

		//item
		$toursaleId = $this->toursaleList[$_SESSION["loginID"]['ticket']]['id'];
		$db->assign('toursaleId', $toursaleId);
		$result = $db->statement('artist/kubota/ticket/sql/item_list.sql');
		$tree = $db->buildTree($result, 'item_code');
		$this->itemList = $tree;
	}
}
?>