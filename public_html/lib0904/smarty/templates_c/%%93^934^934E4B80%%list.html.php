<?php /* Smarty version 2.6.18, created on 2015-03-10 12:35:29
         compiled from artist/kubota/login/backstage_2015/list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'artist/kubota/login/backstage_2015/list.html', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja" link="#000000">
<font size="-1" color="#000000">
<a name="pagetop"></a>
<center>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="../image/symbol_01.gif" alt="" /></td>
		<td><img src="../../../../images/common/dot.gif" width="8" height="0" /><font size="-1" color="#000000">FunkyJam<br /><img src="../../../../images/common/dot.gif" width="6" height="0" />ｵﾗﾊﾝﾅﾄﾍｭ</font></td>
	</tr>
</table>
<hr color="#666666" size="1" noshade="noshade" />
</center>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#662312" width="100%">
	<tr>
		<td align="center"><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /><font color="#FFFFFF">ｸ鮹ｪﾂ�</font><br /><img src="../../../../images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

､ｴｴｾ､ﾎｸ鬢ｪﾁｪ､ﾓ､､､ｿ､ﾀ､ｭ｡｢ｼ｡､ﾎ･ﾚ｡ｼ･ｸ､ﾋｿﾊ､ﾇ､ｯ､ﾀ､ｵ､､｡｣<br />

<form  action="index.php" method="post">
  <input type="hidden" name="action" value="input" />
  <input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />

  <?php if ($this->_tpl_vars['errors'] && ! $this->_tpl_vars['errors']['cart']): ?>
  <font color="#FF0000">｢ｨﾁｪﾂｴｳﾎﾇｧ､ｯ､ﾀ､ｵ､､｡｣</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php endif; ?>
  
<?php $_from = $this->_tpl_vars['units']['places']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['n']['iteration']++;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="3%" valign="top"><input name="place[place]" type="radio" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['place']['place']): ?>checked="checked"<?php endif; ?> /></td>
    <td width="97%"><font size="-1">
<?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('replace', true, $_tmp, " - ", "<br />") : smarty_modifier_replace($_tmp, " - ", "<br />")); ?>
</font></td>
  </tr>
</table>
<br />
<?php endforeach; endif; unset($_from); ?>
  
  <img src="../../../../images/common/dot.gif" width="1" height="20" /><br />
  <center>
  <table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
    <tr>
      <td align="center"><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="ｼ｡､ﾘ" /><br /><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /></td>
      </tr>
  </table>
  </center>
</form>

<img src="../../../../images/common/dot.gif" width="1" height="18" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">｢｣</font></td>
	<td>&nbsp;<a href="../../../../privacy.html"><font color="#000000" size="-1">ｸﾄｿﾍｾﾝｸ鑅ｿﾋ</font></a></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">｢｣</font></td>
	<td>&nbsp;<a href="../../../../index.html"><font color="#000000" size="-1">･ﾈ･ﾃ･ﾗ･ﾚ｡ｼ･ｸ､ﾘ</font></a></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>