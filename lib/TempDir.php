<?php
require_once(dirname(__FILE__) . '/tempdir/TemporaryDirectory.php');

class TempDir extends TemporaryDirectory {
	
	function TempDir() {
		$temp_dir = dirname(__FILE__) . '/../public_html/img/tmp';
		$root_dir = dirname(__FILE__) . '/../public_html';
		$this->TemporaryDirectory($temp_dir, $root_dir);
	}
}
?>