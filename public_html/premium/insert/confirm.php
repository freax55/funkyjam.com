<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	var $__defaultPage = null;
	var $__defaultAmount = null;
	var $__defaultPageAmount = null;

	function init() {
		DatabaseAction::init();
	
		$this->__defaultPage = 1;
		$this->__defaultAmount = 20;
		$this->__defaultPageAmount = 5;
		$this->_tourGoodsCode = 'A013';
	}

	function prepare() {
		if (!$this->page) {
			$this->page = $this->__defaultPage;
		}
		if (!isset($this->amount)) {
			$this->amount = $this->__defaultAmount;
		}
		
		$this->member_no = mb_convert_kana($this->member_no, 'n', 'EUC-JP');
		$this->zip1 = mb_convert_kana($this->zip1, 'n', 'EUC-JP');
		$this->zip2 = mb_convert_kana($this->zip2, 'n', 'EUC-JP');
		$this->tel1 = mb_convert_kana($this->tel1, 'n', 'EUC-JP');
		$this->tel2 = mb_convert_kana($this->tel2, 'n', 'EUC-JP');
		$this->tel3 = mb_convert_kana($this->tel3, 'n', 'EUC-JP');
	}
		
	function execute() {
	}

	function validate() {
		$cart = $this->cart;

		$this->errors = array();
		
		if (!$this->payment) {
			$this->errors['payment'] = '���򤷤Ƥ���������';
		}

		$this->member_no = str_replace(array(" ","��"), "", $this->member_no);
		if (empty($this->member_no)) {
			$this->errors['member_no'] = '���Ϥ��Ƥ���������';
		} elseif(!$this->isId($this->member_no) || mb_strlen($this->member_no) != 8) {
			$this->errors['member_no'] = 'Ⱦ�ѱѿ���8������Ϥ��Ƥ�������';
		}
		if (!$this->mail) {
			$this->errors['mail'] = '���Ϥ��Ƥ���������';
		}elseif (!$this->isMail($this->mail)) {
			$this->errors['mail'] = '����������������ޤ���';
		}
		else{
			$this->mail = str_replace(array(" ","��"), "", $this->mail);
			$db =& $this->_db;
			if($this->status == "edit"){
				$result = $db->statement('premium/sql/login_list.sql');
				$list = $db->buildTree($result);
				$Coincidence = 0;
				if($list){
					foreach ($list as $value) {
						$key = NULL;
						$key = $value[mail].$value[pass];
						if($key == $this->mail.$this->member_no){
							$Coincidence = 1;
						}
					}
				}
				
				if($Coincidence == 0){
					$this->errors['mail'] = '�᡼�륢�ɥ쥹�ȥѥ���ɤ����פ��ʤ����⤷���ϴ��˹������¤��ڤ�Ƥ���ޤ���';
				}
			}
			else{
				$result = $db->statement('premium/insert/sql/insert_list.sql');
				$tree = $db->buildTree($result, 'item_code');
				function array_flattent($item,$key,$ret){
				if(is_array($item)) array_walk($item,"array_flattent",$ret);
					else $ret[]=$item;
				}
				array_walk($tree,"array_flattent",$new_arr);
				if ($this->mail != $this->confirm ) {
				$this->errors['mail'] = '��ǧ���ϤȰ��פ��Ƥ��ޤ���';
				}
				elseif (in_array($this->mail, $new_arr)) {
					$this->errors['mail'] = '������Υ᡼�륢�ɥ쥹�Ϥ����Ѥˤʤ�ޤ���';
				}
			}
		}
		if(empty($this->last_name)){
			$this->errors['name'] = "���Ϥ��Ƥ���������";
		}
		if(empty($this->first_name)){
			$this->errors['name'] = "���Ϥ��Ƥ���������";
		}
		$key = 'last_kana';
		$key2 = 'first_kana';
print($this->first_name);
print($this->last_name);
print($this->$key);
print($this->$key2);
		if(empty($this->$key) || empty($this->$key2)){
			$this->errors['kana'] = "���Ϥ��Ƥ���������";
		}elseif(!$this->isKatakana($this->$key.$this->$key2)){
			$this->errors['kana'] = "�������ʤ����Ϥ򤪴ꤤ���ޤ���";
		}
		$key = 'tel';
		if(empty($this->$key)){
			$this->errors['tel'] = "���Ϥ��Ƥ���������";
		}elseif(!$this->isTel($this->$key)){
			$this->errors['tel'] = "����������������ޤ���";
		}
		$key = 'check';
		if(empty($this->$key)){
			$this->errors['check'] = "���˿ʤ�ˤ�Ʊ�դ��Ƥ�������ɬ�פ��������ޤ���";
		}

		if (count($this->errors)) {
			return 'cart';
		}
		return true;
	}
}

?>
