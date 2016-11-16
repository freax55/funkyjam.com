<?php
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');

class ItemMaintenanceController extends MaintenanceController
{
	var $categoryList = null;
	var $placeList = null;

	function ItemMaintenanceController() {
		$this->MaintenanceController();

		$this->_base_dir = 'shop/item/';

		$this->tableName = '"item"';
		$this->keyName = 'item_code';
		$this->order = 'p_date';
		$this->where = "category_code = 'A011' and current_date <= p_date and p_release <= current_date";
	}

	function prepareCommonBase() {
		$this->setCategoryList();
		$this->setPlaceList();
	}
	
	function executeList() {
		$this->list = $this->getList();
		$html = $this->fetch($this->_base_dir . 'list_tpl');

		$filename = $_SERVER['SITE_ROOT'] . '/' . $this->_base_dir . 'list.html';
		$fp = fopen($filename, 'w');
		fwrite($fp, $html);
		fclose($fp);
		
		$ret = $this->redirectToURL(dirname($_SERVER['PHP_SELF']) . '/index.php?action=list');
		
		return $ret;
	}
	
	function getList($limit, $offset) {
		$query = 'select * from ' . $this->tableName;
		$query = $this->db->buildQuery($query, $this->where, $this->order, $limit, $offset);
		return $this->db->select($query, array('area', $this->keyName));
	}
	
	function setCategoryList() {
		$query = 'select * from "category"';
		$query = $this->db->buildQuery($query);
		$this->categoryList = $this->db->select($query, 'category_code');
	}

	function setPlaceList() {
		$query = 'select * from "place"';
		$query = $this->db->buildQuery($query);
		$this->placeList = $this->db->select($query, 'place_no');
	}
}

$controller = new ItemMaintenanceController();
$controller->process();

exit();
?>