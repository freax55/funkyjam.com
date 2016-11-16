<?php
/**
 * Project:     Colkey: column of key generate association array.
 * File:        Record.php
 *
 * @link http://www.evol-ni.com/
 * @copyright 2005 evol-ni Co.,Ltd.
 * @author Kawamoto Koo <kwmt@evol-ni.com>
 * @package Colkey
 * @version 0.1
 */
	
class Record
{
	var $table = null;
	var $key = null;
	var $where = null;
	
	var $columns = null;
	
	function Record($table = null, $multi = null) {
		$this->columns = array();
		
		if (isset($table)) {
			$this->table = $table;
		}
		if (isset($multi)) {
			$this->key = $multi;
			$this->where = $multi;
		}
	}

	function addAny($name, $value) {
		$this->addColumn(CK_TYPE_ANY, $name, $value);
	}
	
	function addInt($name, $value) {
		$this->addColumn(CK_TYPE_INT, $name, $value);
	}
	
	function addString($name, $value) {
		$this->addColumn(CK_TYPE_STRING, $name, $value);
	}
	
	function addDate($name, $value) {
		$this->addColumn(CK_TYPE_DATE, $name, $value);
	}
	
	function addColumn($type = null, $name, $value) {
		$column = array();
		$column[CK_KEY_TYPE] = $type;
		$column[CK_KEY_NAME] = $name;
		$column[CK_KEY_VALUE] = $value;
		$this->columns[$name] = $column;
	}
	
	function removeColumn($name) {
		unset($this->columns[$name]);
	}
	
	function getColumns() {
		return $this->columns;
	}

	function existColumn($name) {
		foreach ($this->columns as $column) {
			if ($column[CK_KEY_NAME] == $name) {
				return true;
			}
		}
		return false;
	}
	
	function getColumn($name) {
		foreach ($this->columns as $column) {
			if ($column[CK_KEY_NAME] == $name) {
				return $column;
			}
		}
		return false;
	}

	function getColumnType($name) {
		$column = $this->getColumn($name);

		if (!$column) {
			return null;
		}

		return $column[CK_KEY_TYPE];
	}

	function getColumnValue($name) {
		$column = $this->getColumn($name);

		if (!$column) {
			return null;
		}

		$type = $column[CK_KEY_TYPE];
		$value = $column[CK_KEY_VALUE];
		if ($type == CK_TYPE_STRING || $type == CK_TYPE_DATE) {
			return "'$value'";
		}
		else {
			return $value;
		}
	}

	function getColumnNames() {
		$names = array();
		foreach ($this->columns as $column) {
			$names[$column[CK_KEY_NAME]] = $column[CK_KEY_NAME];
		}
		return $names;
	}
	
	function getColumnValues() {
		$values = array();
		$names = $this->getColumnNames();
		foreach ($names as $name) {
			$values[$name] = $this->getColumnValue($name);
		}
		return $values;
	}
	
	function getPair($name) {
		$value = $this->getColumnValue($name);
		return "$name = $value";
	}
	
	function getPairs() {
		$names = $this->getColumnNames();
		$pairs = array();
		foreach ($names as $name) {
			$pairs[] = $this->getPair($name);
		}
		return $pairs;
	}
}
?>