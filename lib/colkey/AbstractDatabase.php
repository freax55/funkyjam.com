<?php
/**
 * Project:     Colkey: column of key generate association array.
 * File:        AbstructDatabase.php
 *
 * @link http://www.evol-ni.com/
 * @copyright 2005 evol-ni Co.,Ltd.
 * @author Kawamoto Koo <kwmt@evol-ni.com>
 * @package Colkey
 * @version 0.1
 */

class AbstractDatabase
{
	var $dbtype = null;
	var $host = null;
	var $port = null;
	var $dbname = null;
	var $user = null;
	var $password = null;

	var $connection = null;
	var $query = null;
	
	var $mode = CK_MODE_NORMAL;
	var $wrapper = null;
	
	function AbstractDatabase($uri = null) {
		if ($uri) {
			$info = parse_url($uri);
			$this->dbtype = $info['scheme'];
			if (isset($info['path'])) {
				$this->dbname = substr($info['path'], 1);
			}
			$this->host = $info['host'];
			$this->port = $info['port'];
			$this->user = $info['user'];
			$this->password = $info['pass'];
		}
		
		$this->wrapper = new DatabaseWrapper($this->dbtype);
	}
	
	function connect() {
		if (!$this->connection) {
			$this->connection = $this->wrapper->connect($this->host, $this->port, $this->dbname, $this->user, $this->password);
		}
		return $this->connection;
	}
	
	function reconnect() {
		$this->close();
		return $this->connect();
	}

	function close() {
		if (!$this->connection) {
			return false;
		}

		$result = $this->wrapper->close($this->connection);
		$this->connection = null;
		return $result;
	}

	function begin() {
		return $this->executeQuery('begin');
	}
	
	function commit() {
		return $this->executeQuery('commit');
	}
	
	function rollback() {
		return $this->executeQuery('rollback');
	}

	function execute() {
		if (!$this->query) {
			return null;
		}
		
		return $this->executeQuery($this->query);
	}

	function executeQuery($query) {
		if (!$this->connect()) {
			return null;
		}
		if (!$query) {
			return null;
		}
		
		if ($this->mode == CK_MODE_DEBUG || $this->mode == CK_MODE_DUMP) {
			print("<pre>$query\n<pre>");
		}
		if ($this->mode == CK_MODE_NORMAL || $this->mode == CK_MODE_DUMP) {
			$result = $this->wrapper->query($this->connection, $query);
		}
		$this->query = $query;
		return $result;
	}
	
	function getAssocArray($query) {
		if (!$query) {
			return null;
		}

		$list = $this->select($query);
		if (!is_array($list) || count($list) <= 0) {
			return null;
		}
		
		return array_shift($list);
	}
	
	function getValue($query, $column) {
		if (!$query || !$column) {
			return null;
		}

		$row = $this->getAssocArray($query);
		
		if (!is_array($row)) {
			return null;
		}

		return $row[strtolower($column)];
	}
	
	function select($query, $keys = null) {
		if (!$query) {
			return null;
		}
		
		$result = $this->executeQuery($query);

		if (!$result) {
			return null;
		}
		
		return $this->buildTree($result, $keys);
	}
	
	function selectTable($table, $keys = null) {
		if (!$table) {
			return null;
		}
		
		$result = $this->executeQuery("select * from $table");

		if (!$result) {
			return null;
		}
		
		return $this->buildTree($result, $keys);
	}
	
	function buildQuery($query, $where = null, $order = null, $limit = null, $offset = null) {
		if ($where) {
			if (is_object($where)) {
				$pairs = $where->getPairs();
				$where = implode(' and ', $pairs);
			}
			$query .= " where $where";
		}
		if ($order) {
			$query .= " order by $order";
		}
		if ($limit) {
			$query .= " limit $limit";
			if ($offset) {
				$query .= " offset $offset";
			}
		}
		return $query;
	}

	function buildTree(&$result, $keys = null) {
		if (!$result) {
			return null;
		}
		
		if ($keys && !is_array($keys)) {
			$keys = array($keys);
		}
		$list = array();
		while ($row = $this->wrapper->fetch_assoc($result)) {
			$this->_buildTree($list, $row, $keys);
		}
		return $list;
	}
	
	function _buildTree(&$list, $row, $keys = null) {
		if (!is_array($list) || !$row) {
			return;
		}

		$currentKey = null;
		$currentValue = null;
		$childKey = null;
		$childValue = null;

		if ($keys && is_array($keys) && 0 < count($keys)) {
			if (0 < count($keys)) {
				$currentKey = $keys[0];
				if (isset($row[$keys[0]])) {
					$currentValue = $row[$currentKey];
				}
			}
			if (1 < count($keys)) {
				$childKey = $keys[1];
				if (isset($row[$keys[1]])) {
					$childValue = $row[$childKey];
				}
			}
		}
		if ($currentValue && $childKey) {
			if (!is_array($list[$currentValue])) {
				$list[$currentValue] = array();
			}
			array_shift($keys);
			$this->_buildTree($list[$currentValue], $row, $keys);
		}
		else if ($currentValue) {
			$list[$currentValue] = $row;
		}
		else {
			$list[] = $row;
		}
	}
	
	function insert($record, $table = null, $key = null) {
		if (isset($table)) {
			$record->table = $table;
		}
		if (isset($key)) {
			$record->key = $key;
		}

		if (!is_object($record) || !$record->table || !$record->key) {
			return null;
		}
		
		$table = $record->table;
		$key = $record->key;
		if (!$record->getColumnValue($key)) {
			$record->addColumn(CK_TYPE_INT, $key, $this->getNewNo($table, $key));
		}
		$names = implode(', ', $record->getColumnNames());
		$values = implode(', ', $record->getColumnValues());
		$query = "insert into $table ($names) values ($values)";
		$result = $this->executeQuery($query);
		return $this->wrapper->affected_rows($result);
	}
	
	function getNewNo($table, $column) {
		$query = "select max($column) as maxValue from $table";
		$maxValue = $this->getValue($query, 'maxValue');
		if (!$maxValue) {
			return 1;
		}
		else {
			return $maxValue + 1;
		}
	}

	function update($record, $table = null, $where = null) {
		if (isset($table)) {
			$record->table = $table;
		}
		if (isset($where)) {
			$record->where = $where;
		}
		
		if (!is_object($record) || !$record->table) {
			return null;
		}
		
		$table = $record->table;
		$where = $record->where;
		$pairs = implode(', ', $record->getPairs());
		$query = "update $table set $pairs";
		if ($where) {
			$query .= " where $where";
		}
		$result = $this->executeQuery($query);
		
		if (!$result) {
			return null;
		}

		return $this->wrapper->affected_rows($result);
	}
	
	function delete($table, $where = null) {
		if (!$table) {
			return null;
		}
		
		$query = "delete from $table";
		if ($where) {
			$query .= " where $where";
		}
		$result = $this->executeQuery($query);
		return $this->wrapper->affected_rows($result);
	}

	function smartInsert($record, $table = null, $key = null) {
		if (isset($table)) {
			$record->table = $table;
		}
		if (isset($key)) {
			$record->key = $key;
		}
		
		if (!is_object($record) || !$record->table || !$record->key || !$record->getColumnValue($record->key)) {
			return null;
		}

		$table = $record->table;
		$key = $record->key;
		$value = $record->getColumnValue($record->key);
		$query = $this->buildQuery("select count(*) as length from $table", "$key = $value");
		$length = $this->getValue($query, 'length');

		$result = null;
		if ($length == 1) {
			$record->where = $record->getPair($key);
			$record->removeColumn($key);
			$result = $this->update($record);
		}
		else {
			$result = $this->insert($record);
		}
		
		return $result;
	}
}
?>