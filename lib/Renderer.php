<?php
require_once(dirname(__FILE__) . '/smarty/libs/Smarty.class.php');

class Renderer extends Smarty {
	function Renderer() {
		$this->Smarty();
		$this->caching = false;
		
		$this->plugins_dir[] = '/../../smarty_plugins';

//		$this->load_filter('pre','sjis2euc');
//		$this->load_filter('pre','ssi2php');
//		$this->load_filter('post','euc2sjis');
    }
}
?>
