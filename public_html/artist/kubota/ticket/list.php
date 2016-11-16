<?php
require_once('auth.php');

class Action extends AuthAction {
	function prepare() {
		parent::prepare();
		
		$this->toursaleList = $this->dbTable('toursale', 'password', null, "start_date <= current_timestamp AND end_date >= current_timestamp", "id, password, start_date, end_date, payment_end_date");
	}
	function execute() {
		$db =& $this->_db;
		
		//month
		$toursaleId = $this->toursaleList[$_SESSION["loginID"]['ticket']]['id'];
		//$monthList = $this->dbTable('item', null, null, "toursale_id = '{$toursaleId}'", "DISTINCT to_char(p_date,'YYYY') || '-' || to_char(p_date,'MM') || '-01' AS date");
		//$monthList = $this->dbTable('item', null, null, null, "DISTINCT to_char(p_date,'YYYY') || '-' || to_char(p_date,'MM') || '-01' AS date");
		$monthList = $this->dbTable('item', null, null, "item_code in ('KT20150926A','KT20150926S','KT20150927A','KT20150927S','KT20151003A','KT20151003S','KT20151004A','KT20151004S')", "DISTINCT to_char(p_date,'YYYY') || '-' || to_char(p_date,'MM') || '-01' AS date");
		$this->monthList = $monthList;
		
		//item
		$db->assign('toursaleId', $toursaleId);
		$result = $db->statement('artist/kubota/ticket/sql/item_list.sql');
		$tree = $db->buildTree($result, array('date', 'item_code'));
		$this->list = $tree;
	}
}
?>