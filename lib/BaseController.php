<?php
define('USER_ROOT', $_SERVER['USER_ROOT'] . '/');
define('SITE_ROOT', USER_ROOT . '/public_html/');
define('LIB_ROOT', USER_ROOT. '/lib/');

require_once(LIB_ROOT . 'guesswork/Guesswork.php');
require_once(LIB_ROOT . 'BaseValidator.php');
require_once(LIB_ROOT . 'Renderer.php');
require_once(LIB_ROOT . 'RendererView.php');
require_once(LIB_ROOT . 'Database.php');

class BaseController extends Controller
{
	var $_base_dir = null;

	function BaseController() {
		$this->Controller();

		$this->_gw_default_action = 'input';
		$this->_gw_template_engine = 'renderer';
		$this->_gw_template_class = LIB_ROOT . 'Renderer.php';
		$this->_gw_template_templates_dir = USER_ROOT . 'public_html';
		$this->_gw_template_compile_dir = LIB_ROOT . 'smarty/templates_c';
		$this->_gw_template_plugins_dir = array(
			'plugins',
			GUESSWORK_LIB_DIR . DIRECTORY_SEPARATOR . 'plugins',
			LIB_ROOT . DIRECTORY_SEPARATOR . 'smarty_plugins'
		);
	}
	
	function prepareCommonBase() {
		//TODO: Override
	}

    /**
     * Register parameters to session.
     * @access private
     * @return boolean
     */
	function registerSession() {
		if ($this->_gw_disable_session) {
			return false;
		}
		
		// set acceptable form parameters to instance variable
		$vars = get_class_vars(get_class($this));
		$acceptable = array();
		foreach ($vars as $key => $value) {
			if (substr($key, 0, 1) == '_') {
				continue;
			}
			$acceptable[] = $key;
		}

        foreach ($acceptable as $key) {
        	if (isset($this->$key)) {
				$_SESSION[$key] = $this->$key;
			}
        }

/*
		$model = $this->getPropertiesAsModel();
        foreach ($model as $key) {
        	if (isset($this->$key)) {
				$_SESSION[$key] = $this->$key;
			}
        }
*/
		return true;
	}

    /**
     * Load vars from session.
     * @access private
     * @return boolean
     */
	function loadSession() {
		if ($this->_gw_disable_session) {
			return false;
		}
		
		// set acceptable form parameters to instance variable
		$vars = get_class_vars(get_class($this));
		$acceptable = array();
		foreach ($vars as $key => $value) {
			if (substr($key, 0, 1) == '_') {
				continue;
			}
			$acceptable[] = $key;
		}
		
		foreach ($_SESSION as $key => $value) {
			if (in_array($key, $acceptable)) {
				$this->$key = $value;
			}
		}
		
/*
		$model = $this->getPropertiesAsModel();
		$keys = array_keys($model);
		foreach ($_SESSION as $key => $value) {
			if (in_array($key, $keys)) {
				$this->$key = $value;
			}
		}
*/
		return true;
	}

	/**
	* Unregister session vars.
	* @access private
	* @return boolean
	*/
	function unregisterSession() {
		if ($this->_gw_disable_session) {
			return false;
		}
		
		// set acceptable form parameters to instance variable
		$vars = get_class_vars(get_class($this));
		$acceptable = array();
		foreach ($vars as $key => $value) {
			if (substr($key, 0, 1) == '_') {
				continue;
			}
			$acceptable[] = $key;
		}
			
        foreach ($acceptable as $key) {
			session_unregister($key);
        }
		
/*
		$model = $this->getPropertiesAsModel();
        foreach ($model as $key) {
			session_unregister($key);
        }
*/
		return true;
	}

    /**
     * Fetch view.
     * @access private
     * @return string
     */
    function fetch($template = null) {
        if (!is_object($this->_gw_view)
            || strtolower(get_parent_class($this->_gw_view)) != 'abstractview') {
            $message = "View engine is not initialized correctly.\n"
                . "_gw_template_engine = " . $this->_gw_template_engine . "\n"
                . "_gw_template_ext = " . $this->_gw_template_ext . "\n";
            $this->renderError($message);
            return GW_TERMINATE_PROCESS;
        }

        $model = $this->getPropertiesAsModel();

        if (is_null($template) || $template == '') {
            $class_name = strtolower(get_class($this));
            $base_name = '';

            if (preg_match('/^([^_]+)_*Controller$/i', $class_name, $matches)) {
                $base_name = $matches[1];
            } else {
                $base_name = $class_name;
            }

            if ($this->_gw_action != '' && $this->isActionMethodExists($this->_gw_action)) {
                $template = $this->_gw_action;
            } else {
                $template = $this->_gw_default_action;
            }

            $template_path = $base_name . DIRECTORY_SEPARATOR . $template . '.' . $this->_gw_template_ext;

            if (!$this->_gw_view->isTemplateExists($template_path)) {
                $this->renderError("Template file '" . $this->_gw_template_templates_dir . DIRECTORY_SEPARATOR . $template_path . "' is not exists.");
                return GW_TERMINATE_PROCESS;
            }

            $this->_gw_view->process($template_path, $model);
            return $this->_gw_view->getResult();
        }

        if ($this->_gw_view->isTemplateExists($template . '.' . $this->_gw_template_ext)) {
            $this->_gw_view->process($template . '.' . $this->_gw_template_ext, $model);
            return $this->_gw_view->getResult();
        }

        $this->_gw_view->process($template_path, $model);
        return $this->_gw_view->getResult();
	}
}
?>