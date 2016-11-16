<?php
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');
require_once('./validator.php');

class CategoryMaintenanceController extends MaintenanceController
{
	var $category_code = null;
	var $name = null;
	var $kind = null;
	var $note = null;
	
	function CategoryMaintenanceController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/category/';

		$this->tableName = '"category"';
		$this->keyName = 'category_code';
		$this->order = 'category_code';
	}

	function prepareCommonBase() {
	}

	function getRecord() {
		$rec = new Record();
		$rec->addString('category_code', $this->category_code);
		$rec->addString('name', $this->name);
		$rec->addString('kind', $this->kind);
		$rec->addString('note', $this->note);
		return $rec;
	}

	function getAssocArray() {
		$query = 'select * from ' . $this->tableName;
		$query = $this->db->buildQuery($query, $this->keyName . " = '" . $this->key . "'");
		return $this->db->getAssocArray($query);
	}

	function insertRecord() {
		$record = $this->getRecord();
		$tableName = $this->tableName;
		$keyName = $this->keyName;
		$this->db->smartInsert($record, $tableName, $keyName);
	}
	
	function updateRecord() {
		$record = $this->getRecord();
		$tableName = $this->tableName;
		$where = $this->keyName . " = '" . $this->key . "'";
		$this->updateFilter($record, $tableName, $where);
		$this->db->update($record, $tableName, $where);
	}

	function deleteRecord() {
		$tableName = $this->tableName;
		$where = $this->keyName . " = '" . $this->key . "'";
		$this->deleteFilter($tableName, $where);
		$this->db->delete($tableName, $where);
	}
}

$controller = new CategoryMaintenanceController();
$controller->process();

exit();
?>