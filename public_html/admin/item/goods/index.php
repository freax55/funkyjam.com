<?php
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');
require_once('./validator.php');
require_once($_SERVER['USER_ROOT'] . '/lib/TempDir.php');

class GoodsMaintenanceController extends MaintenanceController
{
	var $td = null;
	var $uploadList = null;

	var $item_code = null;
	var $name = null;
	var $category_code = null;
	var $color = null;
	var $size = null;
	var $stock = null;
	var $p_date = null;
	var $price = null;
	var $area = null;
	var $otherArea = null;
	var $place_no = null;
	var $open_time = null;
	var $start_time = null;
	var $p_release = null;
	var $g_release = null;
	var $note = null;
	var $inquiries = null;
	var $inquiries_tel = null;
	var $image = null;
	var $imageDelete = null;
	
	var $_categoryKind = 'goods';
	var $categoryList = null;
	var $placeList = null;
	var $areaList = null;

	function GoodsMaintenanceController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/item/goods/';

		$this->tableName = '"item"';
		$this->keyName = 'item_code';
		$this->order = 'to_number(inquiries_tel, \'00000\'), c_stamp desc';

		$this->uploadList = array('image');
	}

	function init() {
		MaintenanceController::init();

		$this->td = new TempDir();
	}

	function prepareCommonBase() {
		$this->setPlaceList();
		$this->setCategoryList();
		$this->where = "category_code in ('" . implode("', '", array_keys($this->categoryList)) . "')";
		$this->setAreaList();
	}
	
	function prepareAdd() {
		$this->prepareUpload();

		MaintenanceController::prepareAdd();
	}
	
	function prepareChange() {
		$this->prepareUpload();

		MaintenanceController::prepareChange();
	}

	function prepareUpload() {
		foreach ($this->uploadList as $name) {
			$deleteName = $name . 'Delete';
			if ($this->$deleteName) {
				$this->$name = null;
				continue;
			}

			$upload = $this->$name;
			if ($upload->tmpFilePath) {
				$this->td->addFile($name, $upload->tmpFilePath, $upload->name);
				$this->$name->tmpFilePath = $this->td->getTempFile($name);
			}
			else {
				$this->$name = $_SESSION[$name];
			}
		}
	}

	function getRecord() {
		$rec = new Record();
		$rec->addString('item_code', $this->item_code);
		$rec->addString('name', $this->name);
		$rec->addString('category_code', $this->category_code);
		if ($this->color) {
			$rec->addString('color', $this->color);
		}
		else {
			$rec->addAny('color', 'null');
		}
		if ($this->size) {
			$rec->addString('size', $this->size);
		}
		else {
			$rec->addAny('size', 'null');
		}
		if ($this->stock) {
			$rec->addInt('stock', $this->stock);
		}
		else {
			$rec->addInt('stock', 0);
		}
		if ($this->p_date) {
			$rec->addDate('p_date', $this->p_date);
		}
		else {
			$rec->addAny('p_date', 'null');
		}
		$rec->addInt('price', $this->price);
		if ($this->otherArea) {
			$rec->addString('area', $this->otherArea);
		}
		else {
			$rec->addString('area', $this->area);
		}
		if ($this->place_no) {
			$rec->addInt('place_no', $this->place_no);
		}
		else {
			$rec->addAny('place_no', 'null');
		}
		if ($this->open_time) {
			$rec->addDate('open_time', $this->open_time);
		}
		else {
			$rec->addAny('open_time', 'null');
		}
		if ($this->start_time) {
			$rec->addDate('start_time', $this->start_time);
		}
		else {
			$rec->addAny('start_time', 'null');
		}
		if ($this->p_release) {
			$rec->addDate('p_release', $this->p_release);
		}
		else {
			$rec->addAny('p_release', 'null');
		}
		if ($this->g_release) {
			$rec->addDate('g_release', $this->g_release);
		}
		else {
			$rec->addAny('g_release', 'null');
		}
		$rec->addString('note', $this->note);
		$rec->addString('inquiries', $this->inquiries);
		if ($this->inquiries_tel) {
			$rec->addDate('inquiries_tel', $this->inquiries_tel);
		}
		else {
			$rec->addAny('inquiries_tel', 'null');
		}
		return $rec;
	}

	function copyFile(&$record, $item_code) {
		if ($this->image->tmpFilePath) {
			$filename = $_SERVER['SITE_ROOT'] . '/img/item/' . $item_code;
			$info = pathinfo($this->image->tmpFilePath);
			$ext = $info['extension'];
			if ($ext) {
				$filename .= '.' . $ext;
			}
			
			$this->td->copyFile('image', $filename);
	
			$record->addString('image', $this->td->convertSiteAbsolute($filename));
		}
		else {
			$record->addAny('image', 'null');
		}
	}
	
	function loadFilter($row) {
		foreach ($this->uploadList as $name) {
			if ($this->$name) {
				$tmp_file = $_SERVER['SITE_ROOT'] . $this->$name;
				$this->td->addFile($name, $tmp_file);
	
				$this->$name = new UploadFile();
				$this->$name->tmpFilePath = $this->td->convertSiteAbsolute($this->td->getFile($name));
			}
		}
	}

	function insertFilter(&$record, &$tableName, &$keyName) {
		$this->copyFile($record, $this->item_code);
	}

	function updateFilter(&$record, &$tableName, &$where) {
		$this->removeFile();
		$this->copyFile($record, $this->item_code);
	}
	
	function removeFile() {
		$file = $this->getAssocArray();
		$filename = $_SERVER['SITE_ROOT'] . $file['image'];
		
		unlink($filename);
	}

	function deleteFilter(&$tableName, &$where) {
		$this->removeFile();
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
		$this->insertFilter($record, $tableName, $keyName);
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

	function setCategoryList() {
		$query = 'select * from "category"';
		$where = "kind = '" . $this->_categoryKind . "'";
		$query = $this->db->buildQuery($query, $where);
		$this->categoryList = $this->db->select($query, 'category_code');
	}

	function setPlaceList() {
		$query = 'select * from "place"';
		$query = $this->db->buildQuery($query);
		$this->placeList = $this->db->select($query, 'place_no');
	}

	function setAreaList() {
		$this->areaList = array(
			'関東・甲信越',
			'東北',
			'関西',
			'九州・沖縄'
		);
	}
}

$controller = new GoodsMaintenanceController();
$controller->process();

exit();
?>