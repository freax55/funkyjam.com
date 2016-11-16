<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class Action extends DatabaseAction {

	function prepare() {
		$this->errors = null;
		
		$this->defaultMessages = array(
			'emp' => '���Ϥ򤪴ꤤ���ޤ���',
			'empS' => '����򤪴ꤤ���ޤ���',
			'cmp' => '��ǧ���ϤȰ��פ��Ƥ��ޤ������Ϥ򤴳�ǧ����������',
			'fom' => '�����򤴳�ǧ����������'
		);
		
		$key = 'favorite';
		$this->form[$key] = array();
		$pattern = '/^fav_.+$/';
		foreach (array_keys($this->form) as $name) {
			if(preg_match($pattern, $name) && $this->form[$name]){
				$this->form[$key][$name] = $this->form[$name];
			}
		}
	}

	function validate() {
		$d =& $this->defaultMessages;
		$this->errors = array();	
		$e =& $this->errors;
		$f =& $this->form;
		
		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
		}elseif($this->login_mail != $f['mail']){
			$result = $this->dbTable("magazine", null, null, "mail='{$f['mail']}'", "mail");
			if($result) {
				$e[$key] = "���Ϥ��줿�᡼�륢�ɥ쥹�Ϥ����Ѥ��������ޤ���";
			}
		}
		
		if(empty($f[$key.'2'])){
			$e[$key.'2'] = $d['emp'];
		}elseif(!$this->isMail($f[$key.'2'])){
			$e[$key.'2'] = $d['fom'];
		}elseif($f[$key.'2'] != $f[$key]){
			$e[$key] = $d['cmp'];
		}

		$key = 'sex';
		if(empty($f[$key])){
			$e[$key] = $d['empS'];
		}

		$key = 'birthday';
		$birthday = $f[$key.'_year'] . '-' . $f[$key.'_month'] . '-' .$f[$key.'_day'];
		if(empty($birthday)){
			$e[$key] = $d['emp'];
		}elseif(!$this->isDate($birthday)){
			$e[$key] = $d['fom'];
		}else{
			$f[$key] = $birthday;
		}

		$key = 'pref';
		if(empty($f[$key])){
			$e[$key] = $d['empS'];
		}

		$key = 'password';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}

		if(empty($f[$key.'2'])){
			$e[$key.'2'] = $d['emp'];
		}elseif($f[$key.'2'] != $f[$key]){
			$e[$key] = $d['cmp'];
		}

		$key = 'favorite';
		if(1 > count($this->form[$key])) {
			$e[$key] = $d['empS'];
		}

		if(count($e)) {
			return 'input';
		}

		return true;
	}
}
?>