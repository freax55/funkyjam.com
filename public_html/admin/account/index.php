<?php
ini_set('display_errors', 'On');
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');
require_once('./validator.php');

class AccountMaintenanceController extends MaintenanceController
{
	var $id = null;
	var $password = null;
	var $note = null;
	
	var $_htpasswd_file = null;
	
	function AccountMaintenanceController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/account/';
		$this->amount = 2;

		$this->tableName = '"account"';
		$this->keyName = 'account_no';
		$this->order = 'account_no desc';

		$this->_htpasswd_file = $_SERVER['USER_ROOT'] . '/.shop_account';
	}
	
	function prepareList() {
		MaintenanceController::prepareList();

		$this->updateHtpasswd();
	}

	function getRecord() {
		$rec = new Record();
		$rec->addString('id', $this->id);
		$rec->addString('password', $this->password);
		$rec->addString('note', $this->note);
		return $rec;
	}
	
	function updateHtpasswd() {
		$accountList = $this->getList(2, null);
		
		system('echo > ' . $this->_htpasswd_file);
		foreach ($accountList as $account) {
			system('htpasswd -nb ' . $account['id'] . ' ' . $account['password'] . ' >> ' . $this->_htpasswd_file);
		}
	}
}

$controller = new AccountMaintenanceController();
$controller->process();

exit();
?>