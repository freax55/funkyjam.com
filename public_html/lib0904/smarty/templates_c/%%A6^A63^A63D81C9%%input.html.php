<?php /* Smarty version 2.6.18, created on 2014-11-21 04:26:49
         compiled from contact/input.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'contact/input.html', 45, false),)), $this); ?>
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
当サイトに関するお問い合わせは、下記お問い合わせフォームからお願いいたします。<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<center>
<font color="#FFCC00">※</font>お問い合わせの前に、こちらもご確認ください。<br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<font color="#FFCC00">◆</font><a href="../faq.html"><font color="#FFFFFF">よくある質問</font></a><font color="#FFCC00">◆</font>
</center>
<img src="../images/common/dot.gif" width="1" height="18" /><br />
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
<font color="#FFCC00">[男女]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['sex']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['sex']; ?>
</font><br /><?php endif; ?>
<input type="radio" name="form[sex]" value="女性" <?php if ($this->_tpl_vars['form']['sex'] == "女性"): ?>checked<?php endif; ?> />女性&nbsp;&nbsp;&nbsp;
<input type="radio" name="form[sex]" value="男性" <?php if ($this->_tpl_vars['form']['sex'] == "男性"): ?>checked<?php endif; ?> />男性<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[年齢]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['age']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['age']; ?>
</font><br /><?php endif; ?>
<input type="text" name="form[age]" istyle="4" MODE="numeric" size="4" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['age'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[職業]</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['job']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['job']; ?>
</font><br /><?php endif; ?>
<input name="form[job]" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['job'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[お問い合わせ種別]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<?php if ($this->_tpl_vars['errors']['type']): ?><font color="#A4272C"><?php echo $this->_tpl_vars['errors']['type']; ?>
</font><br /><?php endif; ?>
<select name="form[type]">
<option value="">下記からお選びください</option>
<option value="久保田利伸について"<?php if ($this->_tpl_vars['form']['type'] == '久保田利伸について'): ?> selected="selected"<?php endif; ?>>久保田利伸について</option>
<option value="森大輔について"<?php if ($this->_tpl_vars['form']['type'] == '森大輔について'): ?> selected="selected"<?php endif; ?>>森大輔について</option>
<option value="浦嶋りんこについて"<?php if ($this->_tpl_vars['form']['type'] == '浦嶋りんこについて'): ?> selected="selected"<?php endif; ?>>浦嶋りんこについて</option>
<option value="Brown Eyed Soulについて"<?php if ($this->_tpl_vars['form']['type'] == 'Brown Eyed Soulについて'): ?> selected="selected"<?php endif; ?>>BROWN EYED SOULについて</option>
<option value="新人募集について"<?php if ($this->_tpl_vars['form']['type'] == '新人募集について'): ?> selected="selected"<?php endif; ?>>新人募集について</option>
<option value="採用について"<?php if ($this->_tpl_vars['form']['type'] == '採用について'): ?> selected="selected"<?php endif; ?>>採用について</option>
<option value="ホームページについて"<?php if ($this->_tpl_vars['form']['type'] == 'ホームページについて'): ?> selected="selected"<?php endif; ?>>ホームページについて</option>
<option value="その他"<?php if ($this->_tpl_vars['form']['type'] == 'その他'): ?> selected="selected"<?php endif; ?>>その他</option>
</select><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[お問い合わせ内容]</font>&nbsp;<font color="#A4272C">※必須</font><br />
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
※ご注意<br />
旧形式のアドレス（...や.@を含む等）でのお問い合わせには、返信できない場合がございますので予めご了承ください。<br />
旧形式のアドレスをお使いのお客様は、下記お電話番号からお電話にてお問い合わせください。<br />
<img src="../images/common/dot.gif" width="1" height="18" /><br />
お問合せ<br />
株式会社ファンキー・ジャム<br />
TEL：<a href="tel:03-3470-7707">03-3470-7707</a><br />
mail: <a href="mailto:info@funkyjam.com">info@funkyjam.com</a><br />
(受付時間:平日10:30〜18:30)<br />
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