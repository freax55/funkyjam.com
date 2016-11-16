<?php
require_once('auth.php');

class Action extends AuthAction {
	function init() {
		DatabaseAction::init();
		
		//�����ϰ�Χ400��
		$this->carriage = 400;
	}

	function prepare() {
		$this->member_no = mb_convert_kana($this->member_no, 'n', 'EUC-JP');
		$this->zip1 = mb_convert_kana($this->zip1, 'n', 'EUC-JP');
		$this->zip2 = mb_convert_kana($this->zip2, 'n', 'EUC-JP');
		$this->tel = mb_convert_kana($this->tel, 'n', 'EUC-JP');
		$this->last_kana = mb_convert_kana($this->last_kana, 'KV', 'EUC-JP');
		$this->first_kana = mb_convert_kana($this->first_kana, 'KV', 'EUC-JP');
	}
		
	function execute() {
		switch ($this->payment) {
			case '����ӥ˷��':
			case 'ATM���':
				$this->paygentCarriage = $this->carriage;
				$this->carriage += 300;
				$this->paygentFee = 300;
				break;
		}
		
		$this->carriageTotal = $this->carriage;

		$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no","convenience_store_no");

		$this->units = array(
			"convenience_stores" => $convenience_stores
		);



		$this->valid_term_month = array();
		for($i = 0; $i < 12; $i++) {
			$this->valid_term_month[] = sprintf('%02d', $i + 1);
		}

		$this->valid_term_year = array();
		$year = date('y');
		for($i = 0; $i < 15; $i++) {
			$this->valid_term_year[] =  sprintf('%02d', $year + $i);
		}
	}

	function validate() {
		$cart = $this->cart;

		$this->errors = array();
		
		if (!is_array($cart) || @count($cart) <= 0) {
			$this->errors['cart'] = '�����Ȥ˾��ʤ��������ޤ���';
		}
		if (!$this->payment) {
			$this->errors['payment'] = '���򤷤Ƥ���������';
		}

		$this->member_no = str_replace(array(" ","��"), "", $this->member_no);
		if (empty($this->member_no)) {
			$this->errors['member_no'] = '���Ϥ��Ƥ���������';
		} elseif(!$this->isNumber($this->member_no) || mb_strlen($this->member_no) != 8) {
			$this->errors['member_no'] = 'Ⱦ�ѿ���8������Ϥ��Ƥ�������';
		}

		$this->last_name = str_replace(array(" ","��"), "", $this->last_name);
		$this->first_name = str_replace(array(" ","��"), "", $this->first_name);
		if (!$this->last_name || !$this->first_name) {
			$this->errors['name'] = '���Ϥ��Ƥ���������';
		}

		$this->last_kana = str_replace(array(" ","��"), "", $this->last_kana);
		$this->first_kana = str_replace(array(" ","��"), "", $this->first_kana);
		if (!$this->last_kana || !$this->first_kana) {
			$this->errors['kana'] = '���Ϥ��Ƥ���������';
		}elseif(!$this->isKatakana($this->last_kana) || !$this->isKatakana($this->first_kana)){
			$this->errors['kana'] = '�������ʤ����Ϥ��Ƥ���������';
		}

		$this->zip1 = str_replace(array(" ","��"), "", $this->zip1);
		$this->zip2 = str_replace(array(" ","��"), "", $this->zip2);
		if (!$this->zip1 || !$this->zip2) {
			$this->errors['zip'] = '���Ϥ��Ƥ���������';
		}elseif (!$this->isNumber($this->zip1) || !$this->isNumber($this->zip2)) {
			$this->errors['zip'] = 'Ⱦ�ѿ��������Ϥ��Ƥ���������';
		}

		$this->address1 = str_replace(array(" ","��"), "", $this->address1);
		if (!$this->address1) {
			$this->errors['address'] = '���Ϥ��Ƥ���������';
		}

		$this->tel = str_replace(array(" ","��"), "", $this->tel);
		if (!$this->tel) {
			$this->errors['tel'] = '���Ϥ��Ƥ���������';
		}elseif (!$this->isTel($this->tel)) {
			$this->errors['tel'] = '����������������ޤ���';
		}

		$this->mail = str_replace(array(" ","��"), "", $this->mail);
		if (!$this->mail) {
			$this->errors['mail'] = '���Ϥ��Ƥ���������';
		}elseif (!$this->isMail($this->mail)) {
			$this->errors['mail'] = '����������������ޤ���';
		}elseif ($this->mail != $this->confirm ) {
			$this->errors['mail'] = '��ǧ���ϤȰ��פ��Ƥ��ޤ���';
		}

		if (count($this->errors)) {
			return 'cart';
		}

		return true;
	}
}

?>