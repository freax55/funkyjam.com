<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
	}

	function validate() {
		$this->errors = array();

		$key = 'zip1';
		$key2 = 'zip2';
		if(empty($this->$key) || empty($this->$key2)){
			$this->errors['zip'] = "���Ϥ��Ƥ���������";
		}elseif(!$this->isZip($this->$key.$this->$key2)){
			$this->errors['zip'] = "����������������ޤ���";
		}

		$key = 'address1';
		if(empty($this->$key)){
			$this->errors[$key] = "���򤷤Ƥ���������";
		}

		$key = 'address2';
		if(empty($this->$key)){
			$this->errors[$key] = "���Ϥ��Ƥ���������";
		}

		$key = 'tel';
		if(empty($this->$key)){
			$this->errors[$key] = "���Ϥ��Ƥ���������";
		}elseif(!$this->isTel($this->$key)){
			$this->errors[$key] = "����������������ޤ���";
		}

		if (!$this->mail) {
			$this->errors['mail'] = '���Ϥ��Ƥ���������';
		}elseif (!$this->isMail($this->mail)) {
			$this->errors['mail'] = '����������������ޤ���';
		}
		//�᡼�륢�ɥ쥹��¸�ߥ����å�
		else{
			$this->mail = str_replace(array(" ","��"), "", $this->mail);
			$db =& $this->_db;
			
			$result = $db->statement('mori/entry/sql/mail_exist_check.sql');
			$tree = $db->buildTree($result, 'item_code');
			function array_flattent($item,$key,$ret){
			if(is_array($item)) array_walk($item,"array_flattent",&$ret);
				else $ret[]=$item;
			}
			array_walk($tree,"array_flattent",&$new_arr);
			if ($this->mail != $this->confirm ) {
			$this->errors['mail'] = '��ǧ���ϤȰ��פ��Ƥ��ޤ���';
			}
			elseif (in_array($this->mail, $new_arr)) {
				//������Υ��ɥ쥹��Ʊ���ʤ�ok�Ȥ������Ȥˤ���
				if($this->mail != $this->check_mail){
					var_dump($this->mail);
					var_dump($this->check_mail);
					$this->errors['mail'] = '������Υ᡼�륢�ɥ쥹�Ϥ����Ѥˤʤ�ޤ���';
				}
			}
		}
		$key = "password";
		if (empty($this->$key)) {
			$this->errors[$key] = '���Ϥ��Ƥ���������';
		} elseif(!$this->isId($this->$key) || mb_strlen($this->$key) != 8) {
			$this->errors[$key] = 'Ⱦ�ѱѿ���8������Ϥ��Ƥ�������';
		}

		$key = 'check';
		if(empty($this->$key)){
			$this->errors['check'] = "���˿ʤ�ˤ�Ʊ�դ��Ƥ�������ɬ�פ��������ޤ���";
		}

		if (count($this->errors)) {
			return 'input';
		}
		return true;
	}
}

?>