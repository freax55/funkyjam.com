<?php
require_once('Debug.php');

class DatabaseWrapper extends Debug {
	var $dbtype = null;
	
	var $TYPE_PGSQL = 'pgsql';
	var $TYPE_MYSQL = 'mysql';
	
	function connect($url) {
		$parts = parse_url($url);
		$this->dbtype = $parts['scheme'];
		$host = $parts['host'];
		$port = $parts['port'];
		$user = $parts['user'];
		$password = $parts['pass'];
		$dbname = substr($parts['path'], 1);

		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			if ($port) {
				$host .= ':' . $port;
			}
			$connection = mysql_connect($host, $user, $password);
			mysql_select_db($dbname, $connection);
			mysql_query('set character set ujis');
			return $connection;
		case $this->TYPE_PGSQL:
			$attrs = array();
			if ($host) {
				$attrs[] = 'host=' . $host;
			}
			if ($port) {
				$attrs[] = 'port=' . $port;
			}
			$attrs[] = 'dbname=' . $dbname;
			if ($user) {
				$attrs[] = 'user=' . $user;
			}
			if ($password) {
				$attrs[] = 'password=' . $password;
			}
			$connection = pg_connect(implode(' ', $attrs));
			return $connection;
		}
	}
	
	function close(&$connection) {
		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			return mysql_close($connection);
		case $this->TYPE_PGSQL:
			return pg_close($connection);
		}
	}
	
	function query(&$connection, $query) {
		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			return mysql_query($query, $connection);
		case $this->TYPE_PGSQL:
			return pg_query($connection, $query);
		}
	}
	
	function escape_string($str, &$connection) {
		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			return mysql_real_escape_string($str, $connection);
		case $this->TYPE_PGSQL:
			return pg_escape_string($str);
		}
	}
	
	function fetch_assoc(&$result, $row = null) {
		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			return mysql_fetch_assoc($result);
		case $this->TYPE_PGSQL:
			if ($row) {
				return pg_fetch_assoc($result, $row);
			}
			else {
				return pg_fetch_assoc($result);
			}
		}
	}
	
	function num_rows(&$result) {
		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			return mysql_num_rows($result);
		case $this->TYPE_PGSQL:
			return pg_num_rows($result);
		}
	}
	
	function affected_rows(&$result) {
		switch ($this->dbtype) {
		case $this->TYPE_MYSQL:
			return mysql_affected_rows($result);
		case $this->TYPE_PGSQL:
			return pg_affected_rows($result);
		}
	}
}
?>