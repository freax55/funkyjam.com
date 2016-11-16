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

		
		// IP���ɥ쥹�����å�
		if($this->c->checkIP()) {
		} else {
			$this->__controller->redirectToURL('/index.php?action=ng&ip=true');
			return false;
		}
		
		// �б�ü�������å�
		if($this->c->checkSupportUA()) {
		} else {
			$this->__controller->redirectToURL('/index_unsupported.html');
			return false;
		}

		/**
		 * ǧ�ڥ����å�����˹ԤäƤ��뤫���ԤäƤ��ʤ���Х����å�
		 * �����å������Ƥ��ΤǤϤʤ�����Ͽ������Υ�󥯤νФ�ʬ����Ԥ���
		 *
		 * @todo ���Ȥ�/index.php�Τȥޡ��������Ф�������
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