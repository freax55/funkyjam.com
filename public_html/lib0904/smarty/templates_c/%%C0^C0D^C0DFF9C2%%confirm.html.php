<?php /* Smarty version 2.6.18, created on 2014-11-25 16:42:22
         compiled from artist/kubota/ticket_reserve/confirm.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket_reserve/confirm.html', 44, false),)), $this); ?>
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
	<td align="center">
<font size="1" color="#FFFFFF">
		<img src="/images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="/images/common/dot.gif" width="1" height="5" />

	</td>
</tr>
</table>

<img src="/images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br />�������Ƴ�ǧ����<br /><img src="/images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<center><font color="#A4272C">���Υڡ�������¸����뤳�Ȥ򤪴����פ��ޤ���</font></center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FFCC00">[����ʧ��ˡ]</font><br />
<?php if ($this->_tpl_vars['payment'] == '��Х�����FJSHOP BariBariCrewCARD'): ?>
BariBariCrew�����Ď޷��<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ����ӥ˷��'): ?>
���ݎˎގƷ��<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ATM���'): ?>
ATM���<br />
<?php elseif ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ͽ��'): ?>
BARI BARI CREW�����ɷ�ѡ�ͽ���<br />
<?php endif; ?>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[FC����ֹ�]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[��̾��]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[��̾��(����)]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['last_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['first_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[͹���ֹ�]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['zip1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['zip2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[����]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['address1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['address2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['address3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[�᡼�륢�ɥ쥹]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[Ϣ���������ֹ�]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="20" /><br />

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
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="����ӥ������" /><br /><img src="/images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php else: ?>
�������������ƤϾ嵭���̤�Ǥ����������С��֤���ʸ�����ץܥ����1�٤��������Ƥ���������<br />
���������ߴ�λ���ticket_kubota@funkyjam.com�פ���ǧ�᡼��������������ޤ���ɬ�����Ƥ򤴳�ǧ����������<br />
<br />
<?php if ($this->_tpl_vars['payment'] == '��Х�����FJSHOP BariBariCrewCARD'): ?><!--<font color="#A4272C">���Τ������ߤ�BARI BARI CREW CARD��ͥ�ԥ����ڡ����оݤǤ���</font><br />--><?php endif; ?>
<input type="hidden" name="action" value="process" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="����ʸ�����" /><br /><img src="/images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php endif; ?>
</form>
<center>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<a href="index.php?action=pay&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
">&lt;&lt;���Ƥ�������</a>
</center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
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
#04"><font color="#333333" size="-1">�����åȤˤĤ��ƤΤ��䤤��碌</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">��</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#05"><font color="#333333" size="-1">���꾦����˴�Ť�ɽ��</font></a></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>