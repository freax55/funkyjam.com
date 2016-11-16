<?php
require_once(dirname(__FILE__) . '/smarty/libs/Smarty.class.php');

if (!class_exists('AjaxRenderer')) {

class AjaxRenderer extends Smarty {
	function AjaxRenderer() {
		$this->Smarty();
		$this->caching = false;
		$this->template_dir = dirname(__FILE__) . '/../public_html';
		$this->compile_dir = dirname(__FILE__) . '/smarty/templates_c';
		$this->plugins_dir[] = dirname(__FILE__) . '/smarty/plugins';
		$this->load_filter('output','euc2utf8');
    }
}

}
?>
