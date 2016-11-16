<?php
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');
require_once('./validator.php');

class PlaceMaintenanceController extends MaintenanceController
{
	var $name = null;
	var $address = null;
	var $type = null;
	var $tel = null;
	var $map = null;
	var $access = null;
	var $note = null;
	
	function PlaceMaintenanceController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/place/';

		$this->tableName = '"place"';
		$this->keyName = 'place_no';
		$this->order = 'place_no';
	}

	function prepareCommonBase() {
	}

	function getRecord() {
		$rec = new Record();
		$rec->addString('name', $this->name);
		$rec->addString('address', $this->address);
		$rec->addString('type', $this->type);
		$rec->addString('tel', $this->tel);
		$rec->addString('map', $this->map);
		$rec->addString('access', $this->access);
		$rec->addString('note', $this->note);
		return $rec;
	}
}

$controller = new PlaceMaintenanceController();
$controller->process();

exit();
?>