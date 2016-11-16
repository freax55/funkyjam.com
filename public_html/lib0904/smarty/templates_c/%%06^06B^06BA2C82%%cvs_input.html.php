<?php /* Smarty version 2.6.18, created on 2015-02-27 11:04:00
         compiled from artist/kubota/ticket/cvs_input.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket/cvs_input.html', 39, false),array('modifier', 'nl2br', 'artist/kubota/ticket/cvs_input.html', 68, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja">
<font size="-1" color="#333333">
<a name="pagetop"></a>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" width="100%">
<tr>
	<td align="center"><font size="1" color="#FFFFFF">
		<img src="/images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="/images/common/dot.gif" width="1" height="5" />

	</td>
</tr>
</table>

<img src="/images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br />コンビニ選択画面<br /><img src="/images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="process" />
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />

お支払いにご利用になる<br />
コンビニを以下からお選び下さい。<br />
なお、各コンビニでの支払方法の詳細については<a href="#detail">コチラ</a><br />
<a name="cvsSelect"></a>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<?php if ($this->_tpl_vars['errors']['convenience_store_no']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['convenience_store_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>

<?php $_from = $this->_tpl_vars['units']['convenience_stores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['n']['iteration']++;
?>
&nbsp;<input name="convenience_store_no" type="radio" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['convenience_sore_no'] == $this->_tpl_vars['k']): ?> checked="checked"<?php endif; ?> id="convenience_sore_no<?php echo $this->_tpl_vars['k']; ?>
" /><label for="convenience_sore_no<?php echo $this->_tpl_vars['k']; ?>
"><font color="#A4272C"><?php echo $this->_tpl_vars['v']['name']; ?>
</font></label><br />
<?php endforeach; endif; unset($_from); ?>

<img src="/images/common/dot.gif" width="1" height="10" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="ご注文を確定" /><br /><img src="/images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<a name="detail"></a>
各コンビニでの支払方法のご説明<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php $_from = $this->_tpl_vars['units']['convenience_stores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['n']['iteration']++;
?>
<font color="#FF9E23">●</font><a href="#convenience_store_<?php echo $this->_tpl_vars['k']; ?>
_detail"><?php echo $this->_tpl_vars['v']['name']; ?>
</a><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<?php endforeach; endif; unset($_from); ?>

<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<?php $_from = $this->_tpl_vars['units']['convenience_stores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['n']['iteration']++;
?>
<a name="convenience_store_<?php echo $this->_tpl_vars['k']; ?>
_detail"></a>
<center><font color="#FF9E23">◆</font><?php echo $this->_tpl_vars['v']['name']; ?>
<font color="#FF9E23">◆</font></center>
<font size="1"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['detail'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br /></font>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<?php endforeach; endif; unset($_from); ?>

<center><a href="#cvsSelect">↑コンビニ選択へ</a></center>
</form>
<img src="/images/common/dot.gif" width="1" height="5" /><br />

<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#01"><font color="#333333" size="-1">ご注意</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#02"><font color="#333333" size="-1">お支払について</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#03"><font color="#333333" size="-1">送料について</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#06"><font color="#333333" size="-1">決済手数料について</font></a></td>
	</tr>
	<tr>
		<td align="center" valign="top"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#04"><font color="#333333" size="-1">チケットについてのお問い合わせ</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#05"><font color="#333333" size="-1">特定商取引に基づく表記</font></a></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>