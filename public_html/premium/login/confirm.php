<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/publisherCommon.php');

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	function execute() {
		parent::execute();
		$_SESSION['login_id'] = $this->login_id;
		$this->clearProperties();
		$this->__controller->redirectToURL('/premium/');
	}
	function validate() {
		$this->errors = array();
		
		$db =& $this->_db;
		$result = $db->statement('premium/sql/login_list.sql');
		$list = $db->buildTree($result);		
				
		function array_flattent($item,$key,$ret){
		if(is_array($item)) array_walk($item,"array_flattent",&$ret);
			else $ret[]=$item;
		}
		array_walk($tree,"array_flattent",&$new_arr);
		if (!$this->login_id) {
			$this->errors['login_id'] = 'IDを入力してください。';
		}elseif (!$this->isMail($this->login_id)) {
			$this->errors['login_id'] = 'IDの形式が正しくありません。';
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
				$this->errors['login_id'] = 'IDとPASSが一致しない。または有効期限切れです。';
			}			
		}
		if (!$this->login_pass) {
			$this->errors['login_pass'] = 'PASSを入力してください。';
		}
		if (count($this->errors)) {
			return 'login';
		}

		return true;
	}
}
?>