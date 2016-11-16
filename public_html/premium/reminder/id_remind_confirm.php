<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/publisherCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function execute() {
		parent::execute();
		$db =& $this->_db;
		$db->assign('id', $this->login_id);
		$db->assign('pass', $this->login_pass);
		$result = $db->statement('premium/reminder/sql/login_id.sql');
		$this->no_id = $db->fetch_assoc($result);
	}
	function validate() {
		$this->errors = array();
		
		$db =& $this->_db;
		$result = $db->statement('premium/sql/login_list.sql');
		$list = $db->buildTree($result);		
		if (!$this->login_id) {
			$this->errors['login_id'] = 'ID�����Ϥ��Ƥ���������';
		}elseif (!$this->isMail($this->login_id)) {
			$this->errors['login_id'] = 'ID�η���������������ޤ���';
		}else{
			$Coincidence = 0;
			if($list){
				foreach ($list as $value) {
					$key = NULL;
					$key = $value[mail].$value[pass];
					if($key == $this->login_id.$this->login_pass){
						$Coincidence = 1;
					}
				}
			}
			if($Coincidence == 0){				
				$this->errors['login_id'] = 'ID��PASS�����פ��ʤ����ޤ���ͭ�������ڤ�Ǥ���';
			}			
		}
		if (!$this->login_pass) {
			$this->errors['login_pass'] = 'PASS�����Ϥ��Ƥ���������';
		}
		if (count($this->errors)) {
			return 'id_remind';
		}

		return true;
	}
}
?>