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
		
		$key = 'kana';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		elseif(!$this->isKatakana($f[$key])){
			$e[$key] = $d['fom'];
		}
		
		$key = 'address';
		if(empty($f['zip1'])){
			$e[$key] = '全ての項目の'.$d['emp'];
		}
		elseif(!$this->isNumber($f['zip1'])){
			$e[$key] = '郵便番号の'.$d['fom'];
		}
		elseif(empty($f['zip2'])){
			$e[$key] = '全ての項目の'.$d['emp'];
		}
		elseif(!$this->isNumber($f['zip2'])){
			$e[$key] = '郵便番号の'.$d['fom'];
		}
		elseif(empty($f['pref'])){
			$e[$key] = $d['empS'];
		}
		elseif(empty($f[$key.'1'])){
			$e[$key] = '全ての項目の'.$d['emp'];
		}
		elseif(empty($f[$key.'2'])){
			$e[$key] = '全ての項目の'.$d['emp'];
		}
		
		$key = 'tel';
		$tel = $f[$key.'_1'] . '-' . $f[$key.'_2'] . '-' .$f[$key.'_3'];
		if(empty($tel)){
			$e[$key] = $d['emp'];
		}elseif(!$this->isTel($tel)){
			$e[$key] = $d['fom'];
		}else{
			$f[$key] = $tel;
		}
		
		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
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
			$e[$key] = $d['emp'];
		}

		$key = 'birth';
		if(empty($f[$key.'_year'])){
			$e[$key] = $d['emp'];
		}
		elseif(!$this->isNumber($f[$key.'_year'])){
			$e[$key] = $d['fom'];
		}
		elseif(empty($f[$key.'_month'])){
			$e[$key] = $d['emp'];
		}
		elseif(empty($f[$key.'_day'])){
			$e[$key] = $d['emp'];
		}

		$key = 'member_no';
		if(empty($f[$key])) {
			//$e[$key] = $d['emp'];
		}
		elseif(!$this->isNumber($f[$key])){
			$e[$key] = $d['fom'];
		}
		elseif(mb_strlen($f[$key]) != 8){
			$e[$key] = '8桁でご入力ください';
		}
		
		$key = 'know';
		if(empty($f[$key])) {
			$e[$key] = $d['emp'];
		}
		
		$key = 'doc';
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