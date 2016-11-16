<?php
require_once('TemporaryDirectory.php');

class Uploader extends TemporaryDirectory {
	var $permanent = null;
	var $root = null;
	var $personal = null;
	var $prefix = null;
	var $expire = null;
	var $basename = null;
	
	function Uploader($temporary, $permanent, $root) {
		$this->temporary = $temporary;
		$this->permanent = $permanent;
		$this->root = $root;
	
		$this->TemporaryDirectory($this->temporary);
	}
	
	function init() {
		TemporaryDirectory::init();

		if (!$this->root) {
			$this->root = $_SERVER['DOCUMENT_ROOT'];
		}
		if (!$this->temporary) {
			$this->temporary = $this->root . '/upload/tmp';
		}
		if (!$this->permanent) {
			$this->permanent = $this->root . '/upload';
		}
	}
	
	/**
	* Get temporary path.
	* @access public
	* @return string
	*/
	function getTemporaryPath($key) {
		return $this->getPath($key);
	}

	/**
	* Get temporary path list.
	* @access public
	* @return array
	*/
	function getTemporaryPaths() {
		return $this->getPaths();
	}
	
	/**
	* Get temporary http path.
	* @access public
	* @return string
	*/
	function getTemporaryHttpPath($key) {
		$path = $this->getTemporaryPath($key);
		return $this->convertHttpPath($path);
	}

	/**
	* Get temporary http path list.
	* @access public
	* @return array
	*/
	function getTemporaryHttpPaths() {
		$list = $this->getTemporaryPaths();
		return $this->convertHttpPaths($list);
	}
	
	/**
	* Convert http path.
	* @access public
	* @return string
	*/
	function convertHttpPath($path) {
		return $this->convertRelativePath($path, $this->root);
	}

	/**
	* Convert http path list.
	* @access public
	* @return array
	*/
	function convertHttpPaths($list) {
		return $this->convertRelativePaths($list, $this->root);
	}

	/**
	* Get permanent path.
	* @access public
	* @return string
	*/
	function getPermanentPath($key, $basename = null) {
		$permanentPath = $this->permanent . '/';
		if ($basename) {
			$permanentPath .= trim($basename, '/');
		}
		else {
			$permanentPath .= trim($this->basename, '/');
		}

		$info = pathinfo($this->getTemporaryPath($key));
		$ext = $info['extension'];
		if ($ext) {
			$permanentPath .= '.' . $ext;
		}
		
		return $permanentPath;
	}

	/**
	* Get properties from $_FILES.
	* @access public
	* @return array
	*/
	function getProperties() {
		$files =& $_FILES;

		if (!is_array($files) || count($files) <= 0) {
			return null;
		}

		$hash = array();
		foreach ($files as $key => $value) {
			if (!isset($value)) {
				continue;
			}
			if (preg_match('/^_.*/i', $key)) {
				continue;
			}

			if ($value['tmp_name']) {
				$tmpName = $value['tmp_name'];
				$name = $value['name'];

				$this->add($key, $tmpName, $name);
				$tmpName = $this->getTemporaryPath($key);
				$value['tmp_name'] = $tmpName;
				$value['http_path'] = $this->convertHttpPath($tmpName);

				$hash[$key] = $value;
			}
		}
		
		return $hash;
	}
}
?>