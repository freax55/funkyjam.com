<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/moriCommon.php');

class Action extends CommonAction {
	function execute() {
		parent::execute();
		$this->param = "";
		if($this->login_flg == 'login_ON'){
			$beforeimg = $_SERVER['REQUEST_URI'];
			if (strstr($beforeimg, '.jpg')) {
			    header('Content-type: image/jpeg');
			}elseif(strstr($beforeimg, '.png')){
				 header('Content-type: image/png');
			}elseif(strstr($beforeimg, '.gif')){
				 header('Content-type: image/gif');
			}else{
				$this->__controller->redirectToURL('/mori/');
			}
			$url = "funkyjam";
			if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
				$url = "fj_test";
			}
		    readfile('/home/'.$url.'/public_html'.$beforeimg);
		}
		else{
			$this->__controller->redirectToURL('/mori/');
		};
	}
}
?>