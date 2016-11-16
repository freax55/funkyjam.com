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
			if(is_array($item)) array_walk($item,"array_flattent",&$ret);
				else $ret[]=$item;
			}
			array_walk($tree,"array_flattent",&$new_arr);
			if ($this->mail != $this->confirm ) {
			$this->errors['mail'] = '確認入力と一致していません。';
			}
			elseif (in_array($this->mail, $new_arr)) {
				//ログインのアドレスと同じならokということにする
				if($this->mail != $this->check_mail){
					var_dump($this->mail);
					var_dump($this->check_mail);
					$this->errors['mail'] = 'こちらのメールアドレスはご利用になれません';
				}
			}
		}
		$key = "password";
		if (empty($this->$key)) {
			$this->errors[$key] = '入力してください。';
		} elseif(!$this->isId($this->$key) || mb_strlen($this->$key) != 8) {
			$this->errors[$key] = '半角英数字8桁で入力してください';
		}

		$key = 'check';
		if(empty($this->$key)){
			$this->errors['check'] = "次に進むには同意していただく必要がございます。";
		}

		if (count($this->errors)) {
			return 'input';
		}
		return true;
	}
}

?>