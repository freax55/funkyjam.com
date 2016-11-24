<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty default modifier plugin
 *
 * Type:     modifier<br>
 * Name:     default2<br>
 * Purpose:  designate default value for empty variables
 * @link http://smarty.php.net/manual/en/language.modifier.default2.php
 *          default (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_default2($string, $default = '')
{
    if (!isset($string) || $string === '')
        return $default;
    else
        return mb_convert_encoding($string,"UTF-8","EUC-JP");
}

/* vim: set expandtab: */

?>
