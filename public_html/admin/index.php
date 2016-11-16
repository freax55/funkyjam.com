<?php
require_once($_SERVER['USER_ROOT'] . '/lib/BaseController.php');

class AdminController extends BaseController
{
	var $db = null;

	function AdminController() {
		$this->BaseController();

		$this->_gw_default_action = 'list';
		$this->_base_dir = 'admin/';
	}
	
	function init() {
		$this->db = new Database();
	}

	function prepareList() {
		$this->prepareCommonBase();
	}
	
	function executeList() {
		return $this->render($this->_base_dir . 'list');
	}
}

$controller = new AdminController();
$controller->process();

exit();
?>