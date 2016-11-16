<?php
/**
 * Renderer view class.
 * @author Kawamoto Koo
 * @version 0.1
 */
class RendererView extends AbstractView
{
    /** Smarty instance */
    var $smarty = null;

    /** Result string */
    var $result = null;

    /**
     * Initialize view instance.
     * @access public
     * @param array $config Configuration values
     * @return boolean
     */
    function init($config)
    {
        $smartyClass = '';
        $templateDir = '';
        $compileDir = '';
        $configDir = '';
        $cacheDir = '';
        $pluginsDir = array('plugins', GUESSWORK_LIB_DIR . DIRECTORY_SEPARATOR . 'plugins');

        if (isset($config['_gw_template_class'])) {
            $smartyClass = $config['_gw_template_class'];
        } else {
            trigger_error("Configuration parameter '_gw_template_class' is not defined.",
                          E_USER_ERROR);
        }

        if (isset($config['_gw_template_templates_dir'])) {
            $templateDir = $config['_gw_template_templates_dir'];
        }

        if (isset($config['_gw_template_compile_dir'], $config)) {
            $compileDir = $config['_gw_template_compile_dir'];
        }

        if (isset($config['_gw_template_config_dir'], $config)) {
            $configDir = $config['_gw_template_config_dir'];
        }

        if (isset($config['_gw_template_cache_dir'], $config)) {
            $cacheDir = $config['_gw_template_cache_dir'];
        }

        if (isset($config['_gw_template_plugins_dir'], $config)) {
            $pluginsDir = $config['_gw_template_plugins_dir'];
        }

        if (!class_exists('Smarty')) {
            require_once $smartyClass;
        }

        $this->smarty = new Renderer();
        $this->smarty->template_dir = $templateDir;
        $this->smarty->compile_dir = $compileDir;
        $this->smarty->config_dir = $configDir;
        $this->smarty->cache_dir = $cacheDir;
        $this->smarty->plugins_dir = $pluginsDir;

        return true;
    }

    /**
     * @access public
     * @param string $template Path to template file
     * @param array $model Array of model values
     * @return boolean
     */
    function process($template, $model)
    {
        foreach ($model as $key => $value) {
			$this->smarty->assign($key, $value);
        }

        $this->result = $this->smarty->fetch($template);

        return true;
    }

    /**
     * @access public
     * @return string
     */
    function getResult()
    {
        return $this->result;
    }

    /**
     * @access public
     * @return boolean
     */
    function isTemplateExists($template)
    {
        return $this->smarty->template_exists($template);
    }
}
?>
