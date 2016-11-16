<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
class Action extends DatabaseAction {

	function prepare() {
		$this->errors = null;
		
		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'empS' => '選択をお願いします。',
			'cmp' => '確認入力と一致していません。入力をご確認ください。',
			'fom' => '形式をご確認ください。'
		);

		$this->sname = session_name();
		$this->sid = session_id();
	}

	function validate() {
		$d =& $this->defaultMessages;
		$this->errors = array();	
		$e =& $this->errors;
		$f =& $this->form;
		
		$key = 'name';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		
		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
		}

		if(empty($f[$key.'2']) && !$this->mb){
			$e[$key.'2'] = $d['emp'];
		}elseif(!$this->isMail($f[$key.'2']) && !$this->mb){
			$e[$key.'2'] = $d['fom'];
		}elseif($f[$key.'2'] != $f[$key] && !$this->mb){
			$e[$key] = $d['cmp'];
		}

		$key = "age";
		if(empty($f[$key])){
		}elseif(!preg_match("/^1?[0-9]{1,2}$/", $f[$key])){
			$e[$key] = $d['fom'];
		}

		$key = 'type';
		if(empty($f[$key])){
			$e[$key] = $d['empS'];
		}

		$key = 'content';
		if(empty($f[$key])) {
			$e[$key] = $d['emp'];
		}

		if(count($e)) {
			return 'input';
		}

		return true;
	}
}
?>