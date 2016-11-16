<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
class Action extends DatabaseAction {

	function prepare() {
		$this->errors = null;

		$this->mailConfig = parse_ini_file(dirname(__FILE__) . '/mail.ini', true);
		
		$this->defaultMessages = array(
			'emp' => '���Ϥ򤪴ꤤ���ޤ���',
			'empS' => '����򤪴ꤤ���ޤ���',
			'cmp' => '��ǧ���ϤȰ��פ��Ƥ��ޤ������Ϥ򤴳�ǧ����������',
			'fom' => '�����򤴳�ǧ����������'
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
		
		$key = 'to';
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