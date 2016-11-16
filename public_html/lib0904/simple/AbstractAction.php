<?php
require_once('Debug.php');

class AbstractAction extends Debug {
	var $__controller = null;
	
	function AbstractAction(&$controller) {
		$this->__controller =& $controller;

		$this->Debug();

		$properties = $this->__controller->getProperties();
		$this->setProperties($properties);
	}

	/**
	* Run action.
	* @access public
	* @return mixed
	*/
	function run() {
		$this->init();

		$result = null;

		$this->prepare();
		$condition = $this->validate();
		if ($this->decision($condition)) {
			$result = $this->execute();
		}
		else {
			$result = $this->error($condition);
		}
		$this->dispose();

		return $result;
	}
	
	/**
	* Prepare action.
	* @access public
	*/
	function prepare() {
		//Please implement.
	}
	
	/**
	* Execute action.
	* @access public
	* @return mixed
	*/
	function execute() {
		//Please implement.
	}

	/**
	* Error action.
	* @access public
	* @return mixed
	*/
	function error() {
		//Please implement.
	}

	/**
	* Dispose action.
	* @access public
	*/
	function dispose() {
		//Please implement.
	}
	
	/**
	* Validation action.
	* @access public
	* @return mixed
	*/
	function validate() {
		//Please implement.
	}

	/**
	* Decision action.
	* @access public
	* @return bool
	*/
	function decision($condition) {
		//Please implement.
	}

	/**
	* Set properties.
	* @access public
	*/
	function setProperties(&$hash) {
		foreach ($hash as $key => $value) {
			if (preg_match('/^_.*/i', $key)) {
				continue;
			}

			$this->$key = $value;
		}
	}

	/**
	* Get properties.
	* @access public
	* @return array
	*/
	function getProperties() {
		$hash = array();
		foreach (get_object_vars($this) as $key => $value) {
			if (preg_match('/^_.*/i', $key)) {
				continue;
			}

			$hash[$key] = $value;
		}
		return $hash;
	}

	/**
	* Clear properties.
	* @access public
	*/
	function clearProperties($excludes = null) {
		$hash =& $this->getProperties();
		foreach ($hash as $key => $value) {
			if ($excludes) {
				if (is_array($excludes) && in_array($key, $excludes)) {
					continue;
				}
				elseif ($key == $excludes) {
					continue;
				}
			}

			unset($this->$key);
		}
		
		$this->__controller->clearProperties();
	}
	
	/**
	* Validation methods.
	* @access public
	* @return bool
	*/
	function isNumber($value) {
		return preg_match('/^[0-9]+$/', $value);
	}

	function isId($value) {
		return preg_match('/^[0-9a-zA-Z_]+$/', $value);
	}

	function isTel($value) {
		//return preg_match('/^0([0-9]+\-?[0-9]+)+$/', $value);
		//return preg_match('/^0([0-9]*\-?[0-9]+)+$/', $value);
		return preg_match('/^0(([0-9]0-?[0-9]{4})|([0-9]-?[0-9]{4})|([0-9]{2}-?[0-9]{3})|([0-9]{3}-?[0-9]{2})|([0-9]{4}-?[0-9])|([0-9]{5})|([0-9]{3}-?[0-9]))-?[0-9]{4}$/', $value);
	}

	function isZip($value) {
		return preg_match('/^[0-9]{3}?-?[0-9]{4}$/', $value);
	}

	function isDate($value) {
		return preg_match('/^[0-9]{4}[\-\/\.]?[0-1]?[0-9][\-\/\.]?[0-3]?[0-9]$/', $value);
	}
	function isDateTime($value) {
		if (preg_match('/^[0-9]{4}[\-\/\.]?[0-1]?[0-9][\-\/\.]?[0-3]?[0-9] ?[0-2]?[0-9]:?[0-5]?[0-9]:?[0-5]?[0-9]$/', $value)) {
			return true;
		}
		elseif (preg_match('/^[0-9]{4}[\-\/\.]?[0-1]?[0-9][\-\/\.]?[0-3]?[0-9] ?[0-2]?[0-9]:?[0-5]?[0-9]$/', $value)) {
			return true;
		}
		
		return false;
	}

	function isMail($value) {
//		return ereg('^[0-9a-zA-Z_\.-]+\@[0-9a-zA-Z_\.-]+\.[0-9a-zA-Z]+$', $value);
//		return preg_match('/^[0-9a-zA-Z_\.-]+\@[0-9a-zA-Z_\.-]+\.[0-9a-zA-Z]+$/', $value);
		return preg_match('/^(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|"[^\\\x80-\xff\n\015"]*(?:\\[^\x80-\xff][^\\\x80-\xff\n\015"]*)*")(?:\.(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|"[^\\\x80-\xff\n\015"]*(?:\\[^\x80-\xff][^\\\x80-\xff\n\015"]*)*"))*@(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\x80-\xff\n\015\[\]]|\\[^\x80-\xff])*\])(?:\.(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\x80-\xff\n\015\[\]]|\\[^\x80-\xff])*\]))*$/', $value);
	}
	function isKetaiMail($value) {
		return preg_match('/^[!-?A-~]+@[0-9a-zA-Z_\.-]+\.[0-9a-zA-Z]+$/', $value);
	}

	function isHttpUrl($value) {
		return ereg('^s?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+', $value);
//		return preg_match('/^s?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+$/', $value);
//		return preg_match('/^(?:https?|shttp):\/\/(?:(?:[-_\.!~*\'\(\)a-zA-Z0-9;:&=+\$,]|%[0-9A-Fa-f][0-9A-Fa-f])*@)?(?:(?:[a-zA-Z0-9](?:[-a-zA-Z0-9]*[a-zA-Z0-9])?\.)*[a-zA-Z](?:[-a-zA-Z0-9]*[a-zA-Z0-9])?\.?|[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)(?::[0-9]*)?(?:\/(?:[-_\.!~*\'()a-zA-Z0-9:@&=+$,]|%[0-9A-Fa-f][0-9A-Fa-f])*(?:;(?:[-_\.!~*\'()a-zA-Z0-9:@&=+$,]|%[0-9A-Fa-f][0-9A-Fa-f])*)*(?:\/(?:[-_\.!~*\'()a-zA-Z0-9:@&=+$,]|%[0-9A-Fa-f][0-9A-Fa-f])*(?:;(?:[-_\.!~*\'()a-zA-Z0-9:@&=+$,]|%[0-9A-Fa-f][0-9A-Fa-f])*)*)*)?(?:\?(?:[-_\.!~*\'()a-zA-Z0-9;\/?:@&=+$,]|%[0-9A-Fa-f][0-9A-Fa-f])*)?(?:#(?:[-_\.!~*\'()a-zA-Z0-9;\/?:@&=+$,]|%[0-9A-Fa-f][0-9A-Fa-f])*)?$/', $value);
	}
	function isFtpUrl($value) {
		return preg_match('/^(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|"[^\\\x80-\xff\n\015"]*(?:\\[^\x80-\xff][^\\\x80-\xff\n\015"]*)*")(?:\.(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|"[^\\\x80-\xff\n\015"]*(?:\\[^\x80-\xff][^\\\x80-\xff\n\015"]*)*"))*@(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\x80-\xff\n\015\[\]]|\\[^\x80-\xff])*\])(?:\.(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\x80-\xff\n\015\[\]]|\\[^\x80-\xff])*\]))*$/', $value);
	}

	function isHiragana($value) {
		return preg_match('/^(\xA4[\xA1-\xF3]|\xA1\xBC|\xA1\xA6|\xA1\xA1|\x20)+$/', $value);
	}
	function toHiragana($value) {
		return mb_convert_kana(mb_convert_kana($value,'KV'), 'c');
	}
	
	function isKatakana($value) {
		return preg_match('/^(\xA5[\xA1-\xF6]|\xA1\xBC|\xA1\xA6|\xA1\xA1|\x20)+$/', $value);
	}
	function toKatakana($value) {
		return mb_convert_kana(mb_convert_kana($value,'KV'), 'C');
	}
	function sanitizeKatakana($value) {
		return mb_convert_kana($value,'KV','EUC-JP');
	}
}
?>