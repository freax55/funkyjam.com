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
		//2013年のリニューアルに伴い、一部システムをUTF-8化
		if (preg_match('/\/premium\//',$_SERVER['REQUEST_URI'])) {
			$this->load_filter('pre','sjis2euc');
			$this->load_filter('output','euc2sjis');
		} else if (preg_match('/\/contact|magazine|fanletter|fanclub|fanclubtest\//',$_SERVER['REQUEST_URI'])) {
//			$this->load_filter('pre','utf82euc');
			$this->load_filter('output','utf82utf8');
		} else {
			$this->load_filter('pre','sjis2euc');
			$this->load_filter('output','euc2sjis');
		}
		// $this->load_filter('pre','sjis2euc');
		$this->load_filter('pre','ssi2smarty');
		// $this->load_filter('output','euc2sjis');
    }
}

}
?>
