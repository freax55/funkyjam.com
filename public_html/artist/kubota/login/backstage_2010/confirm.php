<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class Action extends DatabaseAction {

	function getErrorMessages(){
		return array(
			'emp' => '入力をお願いします。',
			'empR' => '選択をお願いします。',
			'empS' => '選択をお願いします。',
			'fom' => '正しい形式で入力してください。',
			'num' => '半角数字で入力してください。',
			'cmp' => '確認入力と一致していません。入力をご確認ください。',
			'mail' => 'Eメールアドレスの形式を確認してください。',
			'over' => '今回のバックステージご案内対象外です。申し訳ございません。',
			'uq' => 'この会員番号でのお申し込みはすでに行われています。心当たりのない方は、大変お手数ですがその旨をお問い合わせ下さい。BARI BARI CREW　03-3470-7709（15：00〜18：00）'
		);
	}

	function validate() {
		$startNo = 87000000;
		$endNo = 93999999;

		
		$d = $this->getErrorMessages();
		$db = new DatabaseConnector($this->_db);
		
		$this->errors = array();
		$e =& $this->errors;
		$f =& $this->data;

		$key = 'place';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}

		$key = 'member_no';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isNumber($f[$key])){
			$e[$key] = $d['num'];
		}elseif(!preg_match("/^[0-9]{8}$/", $f[$key])){
			$e[$key] = $d['fom'];
		}elseif($db->valQuery("select backstage_no from backstage where member_no='$f[$key]';")){
			$e[$key] = $d['uq'];
		}elseif( $startNo - $f[$key] > 0){
			$e[$key] = $d['over'];
		}elseif( $endNo - $f[$key] < 0){
			$e[$key] = $d['over'];
		}

		$key = 'name';
		if(empty($f["last_".$key])){
			$e[$key] = $d['emp'];
		}
		if(empty($f["first_".$key])){
			$e[$key] = $d['emp'];
		}

		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['mail'];
		}elseif($f[$key] != $f[$key."_s"]){
			$e[$key] = $d['cmp'];
		}

		$key = 'zip';
		if(empty($f[$key."1"])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isNumber($f[$key."1"])){
			$e[$key] = $d['num'];
		}elseif(!preg_match("/^[0-9]{3}$/", $f[$key."1"])){
			$e[$key] = $d['fom'];
		}
		
		if(empty($f[$key."2"])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isNumber($f[$key."2"])){
			$e[$key] = $d['num'];
		}elseif(!preg_match("/^[0-9]{4}$/", $f[$key."2"])){
			$e[$key] = $d['fom'];
		}

		$key = 'address';
		if(empty($f["pref_city"])){
			$e[$key] = $d['emp'];
		}
		if(empty($f[$key])){
//			$e[$key] = $d['emp'];
		}
		if(empty($f["other_".$key])){
//			$e[$key] = $d['emp'];
		}

		$key = 'tel';
		if(empty($f[$key."1"])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isNumber($f[$key."1"])){
			$e[$key] = $d['num'];
		}elseif(!preg_match("/^[0-9]{1,4}$/", $f[$key."1"])){
			$e[$key] = $d['fom'];
		}

		if(empty($f[$key."2"])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isNumber($f[$key."2"])){
			$e[$key] = $d['num'];
		}elseif(!preg_match("/^[0-9]{1,4}$/", $f[$key."2"])){
			$e[$key] = $d['fom'];
		}
		
		if(empty($f[$key."3"])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isNumber($f[$key."3"])){
			$e[$key] = $d['num'];
		}elseif(!preg_match("/^[0-9]{1,4}$/", $f[$key."3"])){
			$e[$key] = $d['fom'];
		}


		if(count($e))
			return 'input';


		return true;
	}



}
?>