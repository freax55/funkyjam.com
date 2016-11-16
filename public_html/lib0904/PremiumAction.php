<?php
require_once('DatabaseAction.php');
require_once(dirname(__FILE__) . '/util/mobile_premium/Carrier.php');

/**
 * Premium Action
 *
 * @author DeguchiTatsuya
 * @version 1.0
 *
 */
class PremiumAction extends DatabaseAction {
	var $c;

	function PremiumAction(&$controller) {
		parent::DatabaseAction($controller);
		
		$this->c = new Carrier();

		$this->carrier = $this->c->getCarrierName();

		
		// IPアドレスチェック
		if($this->c->checkIP()) {
		} else {
			$this->__controller->redirectToURL('/index.php?action=ng&ip=true');
			return false;
		}
		
		// 対応端末チェック
		if($this->c->checkSupportUA()) {
		} else {
			$this->__controller->redirectToURL('/index_unsupported.html');
			return false;
		}

		/**
		 * 認証チェックを既に行っているか、行っていなければチェック
		 * チェックして弾くのではなく、登録・解約のリンクの出し分けを行う。
		 *
		 * @todo あとで/index.phpのとマージ出来ればしたい。
		 */
		if($_REQUEST['checkAuth']) {
			$this->checkAuthResult = false;
			if($this->carrier == 'docomo') {
				if(isset($_REQUEST['ncd'])) {
					unset($this->checkAuthResult);
				} else {
					$this->checkAuthResult = true;
					unset($this->ncd);
				}
			} elseif($this->carrier == 'softbank') {
				if(isset($_REQUEST['ncd'])) {
					unset($this->checkAuthResult);
				} else {
					$this->checkAuthResult = true;
					unset($this->ncd);
				}
			} elseif($this->carrier == 'au') {
				if($_REQUEST['rslt_cd'] == '00' && $_REQUEST['rsn_cd'] == '001') {
					$this->checkAuthResult = true;
				}
			}
		} else {
			$getParam = '';
			foreach($_GET as $key => $value) {
				if($this->carrier == 'docomo' && $key == 'uid') {
				} else {
					$getParam .= sprintf('&%s=%s', $key, $value);
				}
			}
			if($this->carrier == 'docomo') {
				$getParam .= '&uid=NULLGWDOCOMO';
			}
			
			$ok_url = sprintf('http://%s%s/index.php?checkAuth=true%s', $_SERVER['HTTP_HOST'], dirname($_SERVER['SCRIPT_NAME']), $getParam);
			$ng_url = $ok_url;
			$this->c->auth($ok_url, $ng_url);
		}
	}
}
?>