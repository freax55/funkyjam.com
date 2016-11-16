<?php
class DatabaseConnector {

	var $db;
	var $vals;
	function DatabaseConnector(&$db){
		$this->db =& $db;
	}
/**
 * Access and get DB's table array tree from Parameter strings.
 * BuildTreeで作るのと同じ形式の戻り値を返します。
 * 引数は各引数名を参考にしてください。詳細はシイバへ。
 */
	function table($table,$key=null,$order=null,$where=null,$select=null,$group=null) {
		$db =& $this->db;
		$sql ="select";
		if(empty($select))
			$sql .= " *";
		else
			$sql .= " " . $select;
		$sql .= " from ". $table;
		if (!empty($where))
			$sql .= " where ".$where;
		if(!empty ($group))
			$sql .=" group by ".$group;
		if(!empty($order))
			$sql .= " order by ".$order;

		$result = $db->query($sql);
		if(count($result))
			return $db->buildTree($result, $key);
		else
			return array();
	}
	/**
	 * Access and get DB's record array from Parameter strings.
	 */
	function record($table,$where=null,$select=null,$group=null) {
		$db =& $this->db;
		$sql ="select";
		if(empty($select))
			$sql .= " *";
		else
			$sql .= " " . $select;
		$sql .= " from ". $table;
		if (!empty($where))
			$sql .= " where ".$where;
		if(!empty ($group))
			$sql .=" group by ".$group;
		$sql .= " limit 0,1;";

		$result = $db->query($sql);
		if($row = $db->fetch_assoc($result))
			return $row;
		else
			return array();
	}

	/**
	 * Access and get DB's table array tree from SQL strings.
	 */
	function query($sql,$key=null) {
		$db =& $this->db;
		if($result = $db->query($sql)) {
			return $db->buildTree($result, $key);
		} else
			return array();
	}
	/**
	 * Access and get DB's value from SQL strings.
	 */
	function valQuery($sql,$key=null) {
		$db =& $this->db;
		if($result = $db->query($sql)) {
			$row = $db->fetch_assoc($result);
			return array_shift($row);
		}else
			return false;
	}
	/**
	 * Access and execute from SQL strings.
	 */
	function exQuery($sql) {
		$db =& $this->db;
		if($result = $db->query($sql))
			return $result;
		else
			return array();
	}

	/**
	 * Bigen transaction.
	 */
	function bigen() {
		$db =& $this->db;
		$db->begin();
	}
	/**
	 * Commit transaction.
	 */
	function commit() {
		$db =& $this->db;
		$db->commit();
	}



	function escapeVals($val) {
		if(is_array($val)) {
			$q = function_exists("escapeVals") ? "escapeVals" : array(&$this, "escapeVals");
			return array_map($q, $val);
		}else {
			if(get_magic_quotes_gpc()) {
				$val = stripslashes($val);
			}
			if(!is_numeric($val)) {
				$ver = explode('.', phpversion());
				if(intval($ver[0].$ver[1])>=43) {
					$val = mysql_real_escape_string($val);
				}else {
					$val = addslashes($val);
					$pre = array('/\n/m', '/\r/m', '/\x1a/m');
					$after = array('\\\n', '\\\r', '\Z');
					$val = preg_replace($pre, $after, $val);
				}
			}
			return $val;
		}
	}

}
?>