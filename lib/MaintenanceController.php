<?php
require_once(dirname(__FILE__) . '/PagingController.php');

class MaintenanceController extends PagingController
{
	var $db = null;
	var $list = null;
	var $key = null;
	var $keyName = null;
	var $tableName = null;
	var $where = null;
	var $order = null;

	var $filter = null;
	var $defaultFilter = 'none';
	var $params = array();

	function MaintenanceController() {
		$this->PagingController();

		$this->_gw_default_action = 'list';

		$this->amount = 30;
		$this->pageAmount = 5;
	}

	function init() {
		$this->db = new Database();
	}
	
	function getRecord() {
		//TODO: Override
	}
	
	function loadFilter(&$row) {
		//TODO: Override
	}

	function renderFilter($action, &$view) {
		//TODO: Override
	}

	function insertFilter(&$record, &$tableName, &$keyName) {
		//TODO: Override
	}

	function updateFilter(&$record, &$tableName, &$where) {
		//TODO: Override
	}

	function deleteFilter(&$tableName, &$where) {
		//TODO: Override
	}

    function prepareList() {
		if (!$this->page) {
			$this->page = 1;
		}

		if (!$this->filter) {
			$this->filter = $this->defaultFilter;
		}

		$this->prepareListBase();
	}

	function prepareListBase() {
		$this->prepareCommonBase();
	}

    function executeList() {
		$length = $this->getLength();
		$this->setPageInfo($length);

		$limit = $this->pageInfo['amount'];
		$offset = $this->pageInfo['first'] - 1;
		$this->list = $this->getList($limit, $offset);
		
		$action = 'list';
		$view = $this->_base_dir . $action;
		$this->renderFilter($action, $view);

		return $this->render($view);
	}
	
	function getLength() {
		$query = 'select count(*) as length from ' . $this->tableName;
		$query = $this->db->buildQuery($query, $this->where);
		return $this->db->getValue($query, 'length');
	}
	
	function getList($limit, $offset) {
		$query = 'select * from ' . $this->tableName;
		$query = $this->db->buildQuery($query, $this->where, $this->order, $limit, $offset);
		return $this->db->select($query, $this->keyName);
	}

    function prepareNew() {
		$this->loadSession();

		$this->prepareNewBase();
	}

	function prepareNewBase() {
		$this->prepareCommonBase();
	}

    function executeNew() {
		$action = 'new';
		$view = $this->_base_dir . $action;
		$this->renderFilter($action, $view);

		return $this->render($view);
	}

    function prepareEdit() {
		if (!$this->key) {
			$action = 'list';
			$view = $this->_base_dir . $action;
			$this->renderFilter($action, $view);

			return $this->render($view);
		}

		$this->prepareEditBase();
	}

	function prepareEditBase() {
		$this->prepareCommonBase();
	}

    function executeEdit() {
		$assocArray = $this->getAssocArray();
		$this->loadAssocArray($assocArray);

		$this->registerSession();

		$action = 'edit';
		$view = $this->_base_dir . $action;
		$this->renderFilter($action, $view);

		return $this->render($view);
	}
	
	function getAssocArray() {
		$query = 'select * from ' . $this->tableName;
		$query = $this->db->buildQuery($query, $this->keyName . ' = ' . $this->key);
		return $this->db->getAssocArray($query);
	}

	function prepareAdd() {
		$this->registerSession();

		$this->prepareNewBase();
	}

	function executeAdd() {
		if (!$this->validate()) {
			$this->prepareNewBase();

			$this->errors = $this->getErrors();
			$action = 'new';
			$view = $this->_base_dir . $action;
			$this->renderFilter($action, $view);

			$ret = $this->render($view);
			$this->errors = null;

			return $ret;
		}
		
		$this->insertRecord();

		$this->unregisterSession();
		return $this->redirectToUrl($this->getRedirectUrl('index.php'));
	}

	function insertRecord() {
		$record = $this->getRecord();
		$tableName = $this->tableName;
		$keyName = $this->keyName;
		$this->insertFilter($record, $tableName, $keyName);
		$this->db->insert($record, $tableName, $keyName);
	}
	
	function prepareChange() {
		$this->registerSession();

		$this->prepareEditBase();
	}

	function executeChange() {
		if (!$this->validate()) {
			$this->prepareEditBase();

			$this->errors = $this->getErrors();
			$action = 'edit';
			$view = $this->_base_dir . $action;
			$this->renderFilter($action, $view);

			$ret = $this->render($view);
			$this->errors = null;

			return $ret;
		}
		
		$this->updateRecord();

		$this->unregisterSession();
		return $this->redirectToUrl($this->getRedirectUrl('index.php'));
	}

	function updateRecord() {
		$record = $this->getRecord();
		$tableName = $this->tableName;
		$where = $this->keyName . ' = ' . $this->key;
		$this->updateFilter($record, $tableName, $where);
		$this->db->update($record, $tableName, $where);
	}
	
	function prepareRemove() {
		if (!$this->key) {
			$action = 'list';
			$view = $this->_base_dir . $action;
			$this->renderFilter($action, $view);

			return $this->render($view);
		}
	}

	function executeRemove() {
		$this->deleteRecord();

		$this->unregisterSession();
		return $this->redirectToUrl($this->getRedirectUrl('index.php'));
	}

	function deleteRecord() {
		$tableName = $this->tableName;
		$where = $this->keyName . ' = ' . $this->key;
		$this->deleteFilter($tableName, $where);
		$this->db->delete($tableName, $where);
	}

    /**
     * Load vars from association array.
     * @access private
     * @return boolean
     */
	function loadAssocArray($row) {
		// set acceptable form parameters to instance variable
		$vars = get_class_vars(get_class($this));
		$acceptable = array();
		foreach ($vars as $key => $value) {
			if (substr($key, 0, 1) == '_') {
				continue;
			}
			$acceptable[] = $key;
		}
		
		$this->key = $row[$this->keyName];
		foreach ($row as $key => $value) {
			if (in_array($key, $acceptable)) {
				$this->$key = $value;
			}
		}
		
		$this->loadFilter($row);

		return true;
	}
	
	function getParameters() {
		$params = array();
		foreach ($this->params as $name) {
			$params[$name] = $this->$name;
		}
		
		return $params;
	}

	function getRedirectUrl($url = 'index.php') {
		$params = $this->getParameters();
		
		if (count($params)) {
			foreach ($params as $key => $value) {
				$params[$key] = $key . '=' . $value;
			}
			$url .= '?' . implode('&', $params);
		}
		
		return $url;
	}
}
?>