<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');

//ini_set('display_errors','on');
//error_reporting(E_ALL);

class Controller extends DefaultController {
	function init() {
		parent::init();

		$this->__defaultAction = 'index';
		$this->__defaultActionFile = $_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php';
		$this->__defaultActionClass = 'DefaultAction';
	}

	function index() {
		require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mobile_premium/Carrier.php');
		$c = new Carrier();
		
		$this->carrier = $c->getCarrierName();


		// IP���ɥ쥹�����å�
		if($c->checkIP()) {
		} else {
			$this->redirectToURL('/index.php?action=ng&ip=true');
			return false;
		}
		
		// �б�ü�������å�
		if($c->checkSupportUA()) {
		} else {
			$this->redirectToURL('/index_unsupported.html');
			return false;
		}

		/**
		 * ǧ�ڥ����å�����˹ԤäƤ��뤫���ԤäƤ��ʤ���Х����å�
		 * �����å������Ƥ��ΤǤϤʤ�����Ͽ������Υ�󥯤νФ�ʬ����Ԥ���
		 * 
		 * @todo ���Ȥ�PremiumAction�Τȥޡ��������Ф�������
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
				if($this->rslt_cd == '00' && $this->rsn_cd == '001') {
					$this->checkAuthResult = true;
					unset($this->rslt_cd);
					unset($this->rsn_cd);
				}
			}
		} else {
			$ok_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . 'index.php?checkAuth=true';
			$ng_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . 'index.php?checkAuth=true';
			if($this->carrier == 'docomo') {
				$ok_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . 'index.php?checkAuth=true&uid=NULLGWDOCOMO';
				$ng_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . 'index.php?checkAuth=true&uid=NULLGWDOCOMO';
			}
			$c->auth($ok_url, $ng_url);
		}
	}
}

$controller = new Controller();
$controller->run();
?>