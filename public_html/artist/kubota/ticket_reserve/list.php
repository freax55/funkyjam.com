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
		$monthList = $this->dbTable('item', null, null, "item_code in ('KT20150424','KT20150425','KT20150428','KT20150429','KT20150501','KT20150502','KT20150505','KT20150506','KT20150509','KT20150510','KT20150514','KT20150515','KT20150517','KT20150520','KT20150521','KT20150523','KT20150524','KT20150527','KT20150528','KT20150530','KT20150531','KT20150603','KT20150606','KT20150610','KT20150612','KT20150613','KT20150617','KT20150618','KT20150621','KT20150626','KT20150627','KT20150703','KT20150704','KT20150709','KT20150711','KT20150712','KT20150719','KT20150720','KT20150725','KT20150726','KT20150728')", "DISTINCT to_char(p_date,'YYYY') || '-' || to_char(p_date,'MM') || '-01' AS date");
		$this->monthList = $monthList;
		
		//item
		$db->assign('toursaleId', $toursaleId);
		$result = $db->statement('artist/kubota/ticket/sql/item_list.sql');
		$tree = $db->buildTree($result, array('date', 'item_code'));
		$this->list = $tree;
	}
}
?>