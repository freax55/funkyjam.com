<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	function init() {
		DatabaseAction::init();
	}

	function prepare() {
	}
		
	function execute() {
	}

	function validate() {
		$cart = $this->cart;
		$this->errors = array();

		if(empty($this->last_name)){
			$this->errors['name'] = "入力してください。";
		}
		if(empty($this->first_name)){
			$this->errors['name'] = "入力してください。";
		}

		$key = 'last_kana';
		$key2 = 'first_kana';
		if(empty($this->$key) || empty($this->$key2)){
			$this->errors['kana'] = "入力してください。";
		}elseif(!$this->isKatakana($this->$key.$this->$key2)){
			$this->errors['kana'] = "カタカナで入力をお願いします。";
		}

		$key = 'last_roman';
		$key2 = 'first_roman';
		if(empty($this->$key) || empty($this->$key2)){
			$this->errors['roman'] = "入力してください。";
		}elseif(!preg_match('/^[a-zA-Z_]+$/', $this->$key.$this->$key2)){
			$this->errors['roman'] = "英字で入力をお願いします。";
		}

		$key = 'zip1';
		$key2 = 'zip2';
		if(empty($this->$key) || empty($this->$key2)){
			$this->errors['zip'] = "入力してください。";
		}elseif(!$this->isZip($this->$key.$this->$key2)){
			$this->errors['zip'] = "形式が正しくありません。";
		}

		$key = 'address1';
		if(empty($this->$key)){
			$this->errors[$key] = "選択してください。";
		}

		$key = 'address2';
		if(empty($this->$key)){
			$this->errors[$key] = "入力してください。";
		}

		$key = 'tel';
		if(empty($this->$key)){
			$this->errors[$key] = "入力してください。";
		}elseif(!$this->isTel($this->$key)){
			$this->errors[$key] = "形式が正しくありません。";
		}

		if (!$this->mail) {
			$this->errors['mail'] = '入力してください。';
		}elseif (!$this->isMail($this->mail)) {
			$this->errors['mail'] = '形式が正しくありません。';
		}
		//メールアドレスの存在チェック
		else{
			$this->mail = str_replace(array(" ","　"), "", $this->mail);
			$db =& $this->_db;
			
			$result = $db->statement('mori/entry/sql/mail_exist_check.sql');
			$tree = $db->buildTree($result, 'item_code');
			function array_flattent($item,$key,$ret){
			if(is_array($item)) array_walk($item,"array_flattent",$ret);
				else $ret[]=$item;
			}
			array_walk($tree,"array_flattent",$new_arr);
			if ($this->mail != $this->confirm ) {
			$this->errors['mail'] = '確認入力と一致していません。';
			}
			elseif (in_array($this->mail, $new_arr)) {
				$this->errors['mail'] = 'こちらのメールアドレスはご利用になれません';
			}
		}
		$key = 'sex';
		if(empty($this->$key)){
			$this->errors[$key] = "選択してください。";
		}

		$key = "birth_year";
		if(empty($this->$key)){
			$this->errors["birth"] = "選択してください。";
		}

		$key = "birth_month";
		if(empty($this->$key)){
			$this->errors["birth"] = "選択してください。";
		}

		$key = "birth_day";
		if(empty($this->$key)){
			$this->errors["birth"] = "選択してください。";
		}

		$key = "password";
		if (empty($this->$key)) {
			$this->errors[$key] = '入力してください。';
		} elseif(!$this->isId($this->$key) || mb_strlen($this->$key) != 8) {
			$this->errors[$key] = '半角英数字8桁で入力してください';
		}

		if (!$this->payment) {
			$this->errors['payment'] = '選択してください。';
		}

		$key = 'check';
		if(empty($this->$key)){
			$this->errors['check'] = "次に進むには同意していただく必要がございます。";
		}

		if (count($this->errors)) {
			return 'cart';
		}
		return true;
	}
}

?>