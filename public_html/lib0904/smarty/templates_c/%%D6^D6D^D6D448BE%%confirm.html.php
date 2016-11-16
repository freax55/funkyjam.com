<?php /* Smarty version 2.6.18, created on 2014-11-22 19:14:04
         compiled from contact/confirm.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'contact/confirm.html', 36, false),array('modifier', 'nl2br', 'contact/confirm.html', 71, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/common.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja" link="#FFFFFF">
<font size="-1" color="#FFFFFF">
<a name="pagetop"></a>
<center><!-- InstanceBeginEditable name="header" -->
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="../images/common/logo.gif" width="50" height="26" /></td>
		<td>&nbsp;<font size="1" color="#FFFFFF">Official mobile site</font></td>
	</tr>
</table>
<!-- InstanceEndEditable --></center>
<!-- InstanceBeginEditable name="main" -->
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#333333" width="100%">
	<tr>
		<td><img src="../images/common/dot.gif" width="4" height="1" /><img src="../images/common/t_contact.gif" width="78" height="26" /></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="process" />
<input type="hidden" name="mb" value="1" />
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />

<font color="#FFCC00">[お名前]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />

<font color="#FFCC00">[メールアドレス]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />

<?php if ($this->_tpl_vars['form']['sex']): ?>
<font color="#FFCC00">[男女]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['sex'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['form']['age']): ?>
<font color="#FFCC00">[年齢]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['age'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['form']['job']): ?>
<font color="#FFCC00">[職業]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['job'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<?php endif; ?>

<font color="#FFCC00">[お問い合わせ種別]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['type'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[お問い合わせ内容]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['form']['content'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="20" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="上記の内容で送信する" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
</form>

<img src="../images/common/dot.gif" width="1" height="18" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="../privacy.html"><font color="#FFFFFF" size="-1">個人情報保護方針</font></a></td>
	</tr>
</table>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="footer" -->
<!-- InstanceEndEditable -->
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="../index.html"><font color="#FFFFFF" size="-1">トップページへ</font></a></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body><!-- InstanceEnd --></html>