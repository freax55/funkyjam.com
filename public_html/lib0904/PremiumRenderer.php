<?php
require_once(dirname(__FILE__) . '/smarty/libs/Smarty.class.php');

if (!class_exists('PremiumRenderer')) {

class PremiumRenderer extends Smarty {
	function PremiumRenderer() {
		$this->Smarty();
		$this->caching = false;
		$this->template_dir = $_SERVER['DOCUMENT_ROOT'];
		$this->compile_dir = dirname(__FILE__) . '/smarty/templates_c';
		$this->plugins_dir[] = dirname(__FILE__) . '/smarty/plugins';
		$this->load_filter('pre','sjis2euc');
		$this->load_filter('pre','ssi2smarty');

		$c = new Carrier();
		$carrier = $c->getCarrierName();
		if($carrier == 'docomo') {
			$this->load_filter('output','premium_docomo');
		}
		
		$this->load_filter('output','mobile');
		$this->load_filter('output','euc2sjis');
    }
}

}
?>
