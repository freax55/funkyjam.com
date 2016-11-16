<?php
/**
 * Returns an array of all the given parameters.
 *
 * Example:
 * <code>
 * a('a', 'b')
 * </code>
 *
 * Would return:
 * <code>
 * array('a', 'b')
 * </code>
 *
 * @return array Array of given parameters
 */
	function a() {
		$args = func_get_args();
		return $args;
	}
/**
 * Constructs associative array from pairs of arguments.
 *
 * Example:
 * <code>
 * aa('a','b')
 * </code>
 *
 * Would return:
 * <code>
 * array('a'=>'b')
 * </code>
 *
 * @return array Associative array
 */
	function aa() {
		$args = func_get_args();
		for ($l = 0, $c = count($args); $l < $c; $l++) {
			if ($l + 1 < count($args)) {
				$a[$args[$l]] = $args[$l + 1];
			} else {
				$a[$args[$l]] = null;
			}
			$l++;
		}
		return $a;
	}
/**
 * Convenience method for echo().
 *
 * @param string $text String to echo
 */
	function e($text) {
		echo $text;
	}
/**
 * Convenience method for strtolower().
 *
 * @param string $str String to lowercase
 * @return string Lowercased string
 */
	function low($str) {
		return strtolower($str);
	}
/**
 * Convenience method for strtoupper().
 *
 * @param string $str String to uppercase
 * @return string Uppercased string
 */
	function up($str) {
		return strtoupper($str);
	}
/**
 * Convenience method for str_replace().
 *
 * @param string $search String to be replaced
 * @param string $replace String to insert
 * @param string $subject String to search
 * @return string Replaced string
 */
	function r($search, $replace, $subject) {
		return str_replace($search, $replace, $subject);
	}
/**
 * Print_r convenience function, which prints out <PRE> tags around
 * the output of given array. Similar to debug().
 *
 * @see	debug()
 * @param array $var Variable to print out
 * @param boolean $showFrom If set to true, the method prints from where the function was called
 */
	function pr($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
/**
 * Display parameter
 *
 * @param mixed $p Parameter as string or array
 * @return string
 */
	function params($p) {
		if (!is_array($p) || count($p) == 0) {
			return null;
		}
		if (is_array($p[0]) && count($p) == 1) {
			return $p[0];
		}
		return $p;
	}
/**
 * Merge a group of arrays
 *
 * @param array First array
 * @param array Second array
 * @param array Third array
 * @param array Etc...
 * @return array All array parameters merged into one
 */
	function am() {
		$r = array();
		foreach (func_get_args()as $a) {
			if (!is_array($a)) {
				$a = array($a);
			}
			$r = array_merge($r, $a);
		}
		return $r;
	}
?>
