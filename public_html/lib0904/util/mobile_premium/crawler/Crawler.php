<?php
/**
 * au
 *
 * @author DeguchiTatsuya
 * @version 1.0
 * 
 */
class Crawler {

	/**
	 * constructer
	 */
	function Crawler() {
	}

	/**
	 * check support device user agent
	 *
	 * @return boolean
	 */
	function checkSupportUA() {
		if($_SERVER['HTTP_USER_AGENT']) {
		} else {
			return false;
		}
		return true;
	}

	/**
	 * check FlashLite1.1 up support device user agent
	 *
	 * @return boolean
	 */
	function checkFlashSupportUA() {
		if($_SERVER['HTTP_USER_AGENT']) {
		} else {
			return false;
		}
		return true;
	}

	/**
	 * authentication request
	 * 
	 * @param String $ok_url
	 * @param String $ng_url
	 */
	function auth($ok_url = null, $ng_url = null) {
	}

	/**
	 *
	 * @param String $paramName
	 * @return mixed
	 */
	function getParam($paramName) {
		if($this->$paramName) {
			return $this->$paramName;
		}
		return false;
	}

	/**
	 * check ip address
	 *
	 * @return boolean
	 */
	function checkIP() {
		if($_SERVER['REMOTE_ADDR']) {
		} else {
			return false;
		}
		return true;
	}
}
?>
