<?php
/**
 * Project:     Colkey: column of key generate association array.
 * File:        ColkeyWrapper.php
 *
 * @link http://www.evol-ni.com/
 * @copyright 2005 evol-ni Co.,Ltd.
 * @author Kawamoto Koo <kwmt@evol-ni.com>
 * @package Colkey
 * @version 0.1
 */

class DatabaseWrapper
{
	var $dbtype = null;
	
	function DatabaseWrapper($dbtype) {
		$this->dbtype = $dbtype;
	}
	
	function connect($host, $port, $dbname, $user = null, $password = null) {
		if (!$this->dbtype) {
			return null;
		}

		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			$connection = mysql_connect($host, $user, $password);

			if (!$connection) {
				return null;
			}

			mysql_select_db($dbname, $connection);
			return $connection;
		case CK_DB_PGSQL:
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
	
	function close($connection) {
		if (!$this->dbtype) {
			return null;
		}

		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			return mysql_close($connection);
		case CK_DB_PGSQL:
			return pg_close($connection);
		}
	}
	
	function query($connection, $query) {
		if (!$this->dbtype) {
			return null;
		}

		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			return mysql_query($query, $connection);
		case CK_DB_PGSQL:
			return pg_query($connection, $query);
		}
	}
	
	function escape_string($str) {
		if (!$this->dbtype) {
			return null;
		}

		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			return mysql_escape_string($str);
		case CK_DB_PGSQL:
			return pg_escape_string($str);
		}
	}
	
	function fetch_assoc($result, $row = null) {
		if (!$this->dbtype || !$result) {
			return null;
		}
		
		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			return mysql_fetch_assoc($result);
		case CK_DB_PGSQL:
			if ($row) {
				return pg_fetch_assoc($result, $row);
			}
			else {
				return pg_fetch_assoc($result);
			}
		}
	}
	
	function num_rows($result) {
		if (!$this->dbtype || !$result) {
			return null;
		}
		
		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			return mysql_num_rows($result);
		case CK_DB_PGSQL:
			return pg_num_rows($result);
		}
	}
	
	function affected_rows($result) {
		if (!$this->dbtype || !$result) {
			return null;
		}
		
		switch ($this->dbtype) {
		case CK_DB_MYSQL:
			return mysql_affected_rows($result);
		case CK_DB_PGSQL:
			return pg_affected_rows($result);
		}
	}
}