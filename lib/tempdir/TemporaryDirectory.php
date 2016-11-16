<?php
class TemporaryDirectory {
	var $temp_dir = null;
	var $root_dir = null;
	var $base_dir = null;
	var $seconds = 3600;
	
	function TemporaryDirectory($temp_dir = null, $root_dir = null) {
		if (!$temp_dir) {
			$temp_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'tmp';
		}
		$this->temp_dir = '/' . $this->SimplifyPath($temp_dir);

		if (!$root_dir) {
			$root_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..';
		}
		$this->root_dir = '/' . $this->SimplifyPath($root_dir);

		if (!session_id()) {
			session_start();
		}
		$this->base_dir = session_id();

		$this->makeDir();
		
		$this->removeOldDirs();
	}
	
	function addFile($key, $tmp_name, $name = null) {
		if (!$name) {
			$name = $tmp_name;
		}

		$this->makeDir();
		$this->removeDirByDir($this->getDir($key));
		$this->makeDirByDir($this->getDir($key));

		$filename = $this->getFilename($key, $name);
		copy($tmp_name, $filename);
	}
	
	function getFilename($key, $name) {
		if ($name) {
			$info = pathinfo($name);
			$ext = $info['extension'];
		}
		
		$filename = $this->getDir($key) . DIRECTORY_SEPARATOR . $key;
		if ($ext) {
			$filename .= '.' . $ext;
		}
		
		return $filename;
	}
	
	function removeFile($key) {
		$dir = $this->getDir($key);
		if (!file_exists($dir)) {
			return;
		}

		$this->removeDirByDir($dir);
	}
	
	function existsFile($key) {
		$dir = $this->getDir($key);
		return file_exists($dir);
	}
	
	function copyFile($key, $distination) {
		if (!$distination) {
			return;
		}

		$dir = dirname($distination);
		$this->makeParentDir($dir);

		copy($this->getFile($key), $distination);
	}
	
	function makeParentDir($path) {
		if (!$path) {
			return;
		}

		$parentDir = dirname($path);
		if (!file_exists($parentDir)) {
			$this->makeParentDir($parentDir);
		}
		
		if (!file_exists($path)) {
			$this->makeDirByDir($path);
		}
	}
	
	function getDir($key = null) {
		$dir =  $this->temp_dir . DIRECTORY_SEPARATOR . $this->base_dir;
		if ($key) {
			$dir .= DIRECTORY_SEPARATOR . $key;
		}

		if (file_exists($dir)) {
			touch($dir);
		}

		return $dir;
	}

	function getFile($key) {
		$dir = $this->getDir() . DIRECTORY_SEPARATOR . $key;
		$list = $this->getFilesByDir($dir);

		if (count($list) <= 0) {
			return null;
		}
		
		return array_shift($list);
	}

	function getTempFile($key) {
		return $this->convertSiteAbsolute($this->getFile($key));
	}

	function getFiles($absolute = false) {
		$list = $this->getFilesByDir($this->getDir());

		foreach ($list as $key => $filename) {
			$fullpath = $this->getFile($key);
			if ($absolute) {
				$list[$key] = $this->convertSiteAbsolute($fullpath);
			}
			else {
				$list[$key] = $fullpath;
			}
		}
		
		return $list;
	}
	
	function getTempFiles() {
		return $this->getFiles(true);
	}
	
	function getFilesByDir($dir, $recurse = false) {
		if (file_exists($dir)) {
			touch($dir);
		}

		$list = array();
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					$filename = $dir . DIRECTORY_SEPARATOR . $file;
					if ($recurse && is_dir($filename)) {
						$list[$file] = $this->getFilesByDir($filename);
					}
					else {
						$list[$file] = $filename;
					}
				}
			}
			closedir($handle);
		}
		
		return $list;
	}

	function convertSiteAbsolute($filename) {
		return substr($filename, strlen($this->root_dir));
	}

	function makeDir() {
		$this->makeDirByDir($this->getDir());
	}
	
	function makeDirByDir($dir) {
		if (file_exists($dir)) {
			return;
		}

		mkdir($dir);
	}

	function removeDir() {
		$this->removeDirByDir($this->getDir());
	}
	
	function removeDirByDir($dir) {
		if (!file_exists($dir)) {
			return;
		}

		$fileList = $this->getFilesByDir($dir);
		foreach ($fileList as $file) {
			if (is_dir($file)) {
				$this->removeDirByDir($file);
			}
			else {
				unlink($file);
			}
		}
		rmdir($dir);
	}
	
	function removeOldDirs() {
		$dirList = $this->getFilesByDir($this->temp_dir);

		$dateformat = 'Y-m-d H:i:s';
		$n = getdate();
		$threshold = date($dateformat, mktime($n['hours'], $n['minutes'], $n['seconds'] - $this->seconds, $n['mon'], $n['mday'], $n['year']));
		foreach ($dirList as $dir) {
			$mtime = date($dateformat, filemtime($dir));
			if ($mtime < $threshold) {
				$this->removeDirByDir($dir);
			}
		}
	}

	function SimplifyPath($path) {
		$dirs = explode('/',$path);
		
		for($i=0; $i<count($dirs);$i++) {
			if($dirs[$i]=="." || $dirs[$i]=="") {
				array_splice($dirs,$i,1);
				$i--;
			}
	
			if($dirs[$i]=="..") {
				$cnt = count($dirs);
				$dirs=$this->Simplify($dirs, $i);
				$i-= $cnt-count($dirs);
			}
		}

		return implode('/',$dirs);
	}
	
	function Simplify($dirs, $idx) {
		if($idx==0) return $dirs;
		
		if($dirs[$idx-1]=="..") $this->Simplify($dirs, $idx-1);
		else  array_splice($dirs,$idx-1,2);
		
		return $dirs;
	}
}
?>