<?php
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');
require_once('./validator.php');

class MemberMaintenanceController extends MaintenanceController
{
	var $file = null;
		
	function MemberMaintenanceController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/member/';

		$this->amount = 100;
		$this->pageAmount = 25;

		$this->tableName = '"member"';
		$this->keyName = 'member_no';
		$this->order = 'member_no';
	}
	
	function insertRecord() {
		$memberNoList = file($this->file->tmpFilePath);
		
		if (is_array($memberNoList)) {
			for ($i=0; $i<count($memberNoList); $i++) {
				if (!preg_match('/"[0-9]+"/', $memberNoList[$i])) {
					print('Import Error!!<br>Line:' . $i);
					exit();
				}
				else {
					$memberNoList[$i] = substr($memberNoList[$i], 1, strlen($memberNoList[$i]) - 4);
				}
			}

			$this->db->begin();
			$this->db->executeQuery('delete from member');

			for ($i=0; $i<count($memberNoList); $i++) {
				$this->db->executeQuery("insert into member (member_no) values ('" . $memberNoList[$i] . "')");
			}

			$this->db->commit();
		}
	}
}

$controller = new MemberMaintenanceController();
$controller->process();

exit();
?>