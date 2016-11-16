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
		
		$key = 'answer1';
		if(empty($f[$key])){
			$e['answer'] = $d['emp'];
		}
		$key = 'answer2';
		if(empty($f[$key])){
			$e['answer'] = $d['emp'];
		}
		
		$key = 'zipcode';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}

		$key = 'address';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}

		$key = 'name';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}

		$key = 'tel';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		} elseif(!$this->isTel($f[$key])) {
			$e[$key] = $d['fom'];
		}

		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
		}

		if(count($e)) {
			return 'input';
		}

		return true;
	}
}
?>