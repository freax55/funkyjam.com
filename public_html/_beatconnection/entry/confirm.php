<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class ConfirmAction extends DatabaseAction {

	function prepare() {
		$this->errors = null;
		
		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'empS' => '選択をお願いします。',
			'cmp' => '確認入力と一致していません。入力をご確認ください。',
			'fom' => '形式をご確認ください。'
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
		
		$key = 'member_no';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		elseif(!preg_match('/^[0-9]+$/', $f[$key])){
			$e[$key] = $d['fom'];
		}
/*
		else{
			$where = "member_no='%s'";
			$result = $this->dbTable("ticket_entry", null, null, sprintf($where, $this->form['member_no']));
			if($result) {
				$e[$key] = "入力された会員番号はご使用いただけません。";
			}
		}
*/

		$key = 'name';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}

		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
		}
/*
		else{
			$where = "mail='%s'";
			$result = $this->dbTable("ticket_entry", null, null, sprintf($where, $this->form['mail']));
			if($result) {
				$e[$key] = "入力されたメールアドレスはご使用いただけません。";
			}
		}
*/

		$key = 'quantity';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		elseif(!is_numeric($f[$key])){
			$e[$key] = $d['fom'];
		}

		$key = 'tel';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		elseif(!$this->isTel($f[$key])){
			$e[$key] = $d['fom'];
		}

		if(count($e)) {
			return 'input';
		}

		return true;
	}
}
?>