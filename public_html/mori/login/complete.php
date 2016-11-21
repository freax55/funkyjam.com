<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function execute() {
		parent::execute();
		$_SESSION['login_id'] = $this->login_id;

		if (strstr($this->before, '/mori/contents/')) {
			header('Location: '.$this->before);
		}
		$this->clearProperties();
		$this->login_flg = "login_ON";
	}
	function validate() {
		$this->errors = array();
		
		$db =& $this->_db;
		$result = $db->statement('mori/login/sql/mori_login.sql');
		$list = $db->buildTree($result);
				
		function array_flattent($item,$key,$ret){
		if(is_array($item)) array_walk($item,"array_flattent",$ret);
			else $ret[]=$item;
		}
		array_walk($tree,"array_flattent",$new_arr);
		if (!$this->login_id) {
			$this->errors['login_id'] = '����ֹ�����Ϥ��Ƥ���������';
		}else{
			$Coincidence = 0;
			if($list){
				foreach ($list as $value) {
					$key = NULL;
					$key = $value[account_no].$value[pass];
					if($key == $this->login_id.$this->login_pass){
						$Coincidence = 1;
					}
				}
			}
			if($Coincidence == 0){
				$this->errors['login_id'] = '����ֹ�ȥѥ���ɤ����פ��ʤ����ޤ��ϲ����ͭ�����¤��ڤ�Ƥ���ޤ���';
			}			
		}
		if (!$this->login_pass) {
			$this->errors['login_pass'] = '�����Ϥ��Ƥ���������';
		}
		if (count($this->errors)) {
			return 'login';
		}

		return true;
	}
}
?>