<?php /* Smarty version 2.6.18, created on 2015-04-17 02:50:57
         compiled from shop/confirm.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shop/confirm.html', 49, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/fjshop.dwt" codeOutsideHTMLIsLocked="false" -->
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
	<td align="center"><!-- InstanceBeginEditable name="header" -->
<font size="1" color="#FFFFFF">
		<img src="../images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="../images/common/dot.gif" width="1" height="5" />
<!-- InstanceEndEditable -->
	</td>
</tr>
</table>
<!-- InstanceBeginEditable name="main" -->
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br />�������Ƴ�ǧ<br /><img src="../images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />

<font color="#FFCC00">[����ʧ��ˡ]</font><br />
<?php if ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ������'): ?>
������<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ͹�ؿ���'): ?>
͹�ؿ���<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP BariBariCrewCARD'): ?>
BariBariCrew�����Ď޷��<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ����ӥ˷��'): ?>
���ݎˎގƷ��<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP �����ɷ�ѡʥڥ�������ȡ�'): ?>
���ڎ��ގ��Ď����Ď޷��<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ��ԥͥåȷ��'): ?>
��ԎȎ��ķ��<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ATM���'): ?>
ATM���<br />
<?php endif; ?>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[FC����ֹ�]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[��̾��]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[��̾��(����)]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['last_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['first_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[͹���ֹ�]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['zip1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['zip2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[����]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['address1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['address2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['address3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[�᡼�륢�ɥ쥹]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[Ϣ���������ֹ�]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="20" /><br />
<br />
<form action="index.php" method="post">
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<?php if ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ����ӥ˷��'): ?>
<input type="hidden" name="action" value="cvs_input" />
<input type="hidden" name="convenience_store_no" value="" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="����ӥ������" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP �����ɷ�ѡʥڥ�������ȡ�'): ?>
<input type="hidden" name="action" value="card_input" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="�������ֹ����Ϥ�" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ��ԥͥåȷ��'): ?>
<font color="#FF0000">����ԤΥ����ȤˤƤ���ʧ��λ�塢ɬ��FJSHOP�����Ȥؤ���꤯��������</font>
<input type="hidden" name="action" value="net_input" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="��ԥͥåȤ�" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php else: ?>
<input type="hidden" name="action" value="process" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="�嵭�����Ƥ���������" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php endif; ?>
</form>
<center>
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<a href="index.php?action=pay&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
">&lt;&lt;���Ƥ�������</a>
</center>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">��</font></td>
	<td>&nbsp;<a href="../privacy.html"><font color="#333333" size="-1">�Ŀ;����ݸ�����</font></a></td>
	</tr>
</table>
<!-- InstanceEndEditable -->
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#01"><font color="#333333" size="-1">�����</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#02"><font color="#333333" size="-1">����ʧ�ˤĤ���</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#03"><font color="#333333" size="-1">�����ˤĤ���</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#06"><font color="#333333" size="-1">��Ѽ�����ˤĤ���</font></a></td>
	</tr>
	<tr>
		<td align="center" valign="top"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#04"><font color="#333333" size="-1">���ʤˤĤ��ƤΤ��䤤��碌</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#05"><font color="#333333" size="-1">���꾦����˴�Ť�ɽ��</font></a></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">��</font></td>
	<td>&nbsp;<a href="../index.html"><font color="#333333" size="-1">FunkyJam�ȥåץڡ�����</font></a></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body><!-- InstanceEnd --></html>