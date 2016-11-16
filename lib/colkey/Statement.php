<?php
/**
 * Project:     Colkey: column of key generate association array.
 * File:        Statement.php
 *
 * @link http://www.evol-ni.com/
 * @copyright 2005 evol-ni Co.,Ltd.
 * @author Kawamoto Koo <kwmt@evol-ni.com>
 * @package Colkey
 * @version 0.1
 */

class Statement
{
	var $query = null;
	var $patern = '?';
	var $parameters = null;
	
	function Statement($query = null) {
		$this->query = $query;
	}
	
	function build($parameters) {
		if (!is_object($parameters) && !is_array($parameters)) {
			return null;
		}

		if (is_object($parameters)) {
			$this->parameters = $parameters->getValues();
		}
		else {
			$this->parameters = $parameters;
		}
		return $this->implant();
	}
	
	function implant() {
		if (!$this->query || !$this->pattern || !$this->params || !is_array($this->parameters)) {
			return null;
		}
		if (count($this->parameters) <= 0) {
			return $query;
		}

		$query = $this->query;
		$pattern = $this->pattern;
		$parameters = $this->parameters;
		$pieces  = explode($pattern, $query);
		$index = 0;
		for ($i=0; $i<count($pieces)-1; $i++) {
			$piece = $pieces[$i];
			
			if ($piece && mb_strrpos($piece, '\\') === mb_strlen($piece) - 1) {
				$pieces[$i] = mb_substr($piece, 0, mb_strlen($piece) - 1) . $pattern;
			}
			else {
				$index++;
				if (isset($parameters[$index])) {
					$pieces[$i] = $piece . $parameters[$index];
				}
			}
		}
		return implode('', $pieces);
	}
}
?>