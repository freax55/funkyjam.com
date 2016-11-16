<?php /* Smarty version 2.6.18, created on 2014-11-20 23:55:27
         compiled from fanletter/input.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'fanletter/input.html', 37, false),)), $this); ?>
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
		<td><img src="../images/common/dot.gif" width="4" height="1" /><img src="../images/common/t_fanletter.gif" width="108" height="26" /></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="confirm" />
<input type="hidden" name="mb" value="1" />
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />

<font color="#FFCC00">[お名前]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['name']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['name']; ?>
</font><br /><?php endif; ?>
<input type="text" name="form[name]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[メールアドレス]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['mail']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['mail']; ?>
</font><br /><?php endif; ?>
<input type="text" istyle="3" MODE="alphabet" name="form[mail]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[宛先]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['to']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['to']; ?>
</font><br /><?php endif; ?>
<input name="form[to]" type="radio" value="kubota" <?php if ($this->_tpl_vars['form']['to'] == 'kubota'): ?> checked="checked"<?php endif; ?> id="fromToArtist01" />&nbsp;<label for="fromToArtist01">久保田利伸</label><br />
<input name="form[to]" type="radio" value="urashima" <?php if ($this->_tpl_vars['form']['to'] == 'urashima'): ?> checked="checked"<?php endif; ?> id="fromToArtist02" />&nbsp;<label for="fromToArtist02">浦嶋りんこ</label><br />
<input name="form[to]" type="radio" value="mori" <?php if ($this->_tpl_vars['form']['to'] == 'mori'): ?> checked="checked"<?php endif; ?> id="fromToArtist03" />&nbsp;<label for="fromToArtist03">森大輔</label><br />
<input name="form[to]" type="radio" value="bes" <?php if ($this->_tpl_vars['form']['to'] == 'bes'): ?> checked="checked"<?php endif; ?> id="fromToArtist04" />&nbsp;<label for="fromToArtist04">BROWN EYED SOUL</label><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[メッセージ]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['content']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['content']; ?>
</font><br /><?php endif; ?>
<textarea name="form[content]" rows="5"><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['content'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea><br />
<img src="../images/common/dot.gif" width="1" height="20" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="内容を確認する" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
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