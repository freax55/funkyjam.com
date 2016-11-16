<?php
require_once(dirname(__FILE__) . '/smarty/libs/Smarty.class.php');

if (!class_exists('Renderer')) {

class Renderer extends Smarty {
	function Renderer() {
		$this->Smarty();
		$this->caching = false;
		$this->template_dir = $_SERVER['DOCUMENT_ROOT'];
		$this->compile_dir = dirname(__FILE__) . '/smarty/templates_c';
		$this->plugins_dir[] = dirname(__FILE__) . '/smarty/plugins';
		$this->load_filter('pre','sjis2euc');
		$this->load_filter('pre','ssi2smarty');
		$this->load_filter('output','mobile');
		$this->load_filter('output','euc2sjis');
    }
}

}
?>
