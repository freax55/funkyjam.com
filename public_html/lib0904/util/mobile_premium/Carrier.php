<?php
/**
 * Carrier
 *
 * @author DeguchiTatsuya
 * @version 1.0
 * 
 */
class Carrier {

	var $c;
	
	/*
	 * constructer
	 */
	function Carrier($carrier = null) {
		$this->_create($carrier);
		return $this->c;
	}

	function _create($carrier) {
		$CarrierName = $carrier;
		if(!isset($carrier)) {
			$CarrierName = $this->getCarrierName();
		}
		
		if($CarrierName == 'docomo') {
			require_once 'docomo/Docomo.php';
			$this->c = new Docomo();
		} elseif($CarrierName == 'softbank') {
			require_once 'softbank/Softbank.php';
			$this->c = new Softbank();
		} elseif($CarrierName == 'au') {
			require_once 'au/Au.php';
			$this->c = new Au();
		} elseif($CarrierName == 'crawler') {
			require_once 'crawler/Crawler.php';
			$this->c = new Crawler();
		} else {
			return false;
		}
		return true;
	}

	/**
	 * IP address check
	 *
	 * @return boolean
	 */
	function checkIP() {
		if($_SERVER['HTTP_HOST'] == 'm.funkyjam.com') {

		/*▼エボルニ暫定的な処理▼*/
		$ip = $_SERVER["REMOTE_ADDR"];
		if($ip == '182.171.234.187'){
			return true;
		}
		/*▲エボルニ暫定的な処理▲*/

			return $this->c->checkIP();
		}
		return true;
	}
	
	/**
	 * get carrier name
	 *
	 * @param String ip
	 * @return String carrierName
	 */
	function getCarrierName() {
		$carrierName = '';

		if(preg_match('/Y!J-SRD/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/Y!J-MBS/', $_SERVER['HTTP_USER_AGENT'])) {
			// Yahooモバイル
			$carrierName = 'crawler';
		} elseif(preg_match('/Googlebot-Mobile/', $_SERVER['HTTP_USER_AGENT'])) {
			// Googleモバイル
			$carrierName = 'crawler';
		} elseif(preg_match('/LD_mobile_bot/', $_SERVER['HTTP_USER_AGENT'])) {
			// Livedoorモバイル
			$carrierName = 'crawler';
		} elseif(preg_match('/mobile goo/', $_SERVER['HTTP_USER_AGENT'])) {
			// Gooモバイル
			$carrierName = 'crawler';
//		} elseif(isset($_SERVER['HTTP_X_DCMGUID'])) {
		} elseif(preg_match('/^DoCoMo/', $_SERVER['HTTP_USER_AGENT'])) {
			// 全リンクにguid=ONのGETパラメータをつけるのは難しいのでdocomoだけはUAでキャリア判定
			$carrierName = 'docomo';
		} elseif(isset($_SERVER['HTTP_X_JPHONE_UID']) || preg_match('/^SoftBank/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/^J-PHONE/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/^Vodafone/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/^MOT-/', $_SERVER['HTTP_USER_AGENT'])) {
			$carrierName = 'softbank';
		} elseif(isset($_SERVER['HTTP_X_UP_SUBNO'])) {
			$carrierName = 'au';
		}
		return $carrierName;
	}

	/**
	 * check support device user agent
	 *
	 * @return boolean
	 */
	function checkSupportUA() {
		return $this->c->checkSupportUA();
	}

	/**
	 * check FlashLite1.1 up support device user agent
	 *
	 * @return boolean
	 */
	function checkFlashSupportUA() {
		return $this->c->checkFlashSupportUA();
	}

	/**
	 * auth
	 *
	 * @param String $ok_url
	 * @param String $ng_url
	 * @return boolean
	 */
	function auth($ok_url = null, $ng_url = null) {
		$this->c->auth($ok_url, $ng_url);
	}

	/**
	 * get parameter
	 */
	function getParam($paramName = null) {
		if($paramName) {
		} else {
			return false;
		}
		return $this->c->getParam($paramName);
	}

	/**
	 * set parameter
	 */
	function setParam($paramName = null, $value = null) {
		if($paramName) {
		} else {
			return false;
		}
		$this->c->setParam($paramName, $value);
	}
}
?>
