<?php
require_once(dirname(__FILE__) . '/smarty/libs/Smarty.class.php');

if (!class_exists('Renderer')) {

class Renderer extends Smarty {
	function Renderer() {
		$this->Smarty();
		$this->caching = false;
		$this->template_dir = dirname(__FILE__) . '/../public_html';
		$this->compile_dir = dirname(__FILE__) . '/smarty/templates_c';
		$this->plugins_dir[] = dirname(__FILE__) . '/smarty/plugins';
//                $this->load_filter('pre','utf82euc');
 //               $this->load_filter('output','utf82euc');
                if (preg_match('/\/premium\//',$_SERVER['REQUEST_URI'])) {
//                        $this->load_filter('pre','utf82euc');
//                       $this->load_filter('output','euc2utf8');
//                      $this->load_filter('output','utf82euc');
//                      $this->load_filter('output','euc2euc');
//                      $this->load_filter('output','utf82euc');
                }
		$this->load_filter('pre','ssi2smarty');

    }
}

}
?>
