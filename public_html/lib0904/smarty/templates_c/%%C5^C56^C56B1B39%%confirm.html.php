<?php /* Smarty version 2.6.18, created on 2015-03-10 13:02:57
         compiled from artist/kubota/login/backstage_2015/confirm.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'artist/kubota/login/backstage_2015/confirm.html', 34, false),array('modifier', 'escape', 'artist/kubota/login/backstage_2015/confirm.html', 39, false),)), $this); ?>
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
		<td><img src="../../../../images/common/dot.gif" width="8" height="0" /><font size="-1" color="#000000">FunkyJam<br /><img src="../../../../images/common/dot.gif" width="6" height="0" />����������</font></td>
	</tr>
</table>
<hr color="#666666" size="1" noshade="noshade" />
</center>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#662312" width="100%">
	<tr>
		<td align="center"><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /><font color="#FFFFFF">�����;����ǧ</font><br /><img src="../../../../images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

<form  action="index.php" method="post">
  <input type="hidden" name="action" value="process" />
  <input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
  
  <font color="#FFCC00">[�������߸���]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <font size="-1"><?php echo ((is_array($_tmp=$this->_tpl_vars['units']['places'][$this->_tpl_vars['place']['place']])) ? $this->_run_mod_handler('replace', true, $_tmp, " - ", "<br />") : smarty_modifier_replace($_tmp, " - ", "<br />")); ?>
</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  <font color="#FFCC00">[FC����ֹ�]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  <font color="#FFCC00">[��̾��]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&nbsp;(<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['last_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['first_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)<br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  <font color="#FFCC00">[�᡼�륢�ɥ쥹]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  <font color="#FFCC00">[͹���ֹ�]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['zip'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
  
  <font color="#FFCC00">[����]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['pref_city'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['other_address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
    
  <font color="#FFCC00">[Ϣ���������ֹ�]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
  <br />
<center><font color="#FFCC00">��</font>���ٲ�����ջ��ऴ��ǧ����������<font color="#FFCC00">��</font></center>
����������1�����ΤߤȤ����Ƥ��������ޤ���<br />
(PC/���ޥ�/��Х��뤤���줫����1�٤��������Ǥ��ʤ������ƥ�Ǥ�)<br />
<br />
�����������Ƥμ��ä����ѹ��Ϥ����ʤ���ˤ����Ƥ⤪�����Ǥ��ޤ���<br />
<br />
�������ߴ�λ�塢�� artist_kubota@funkyjam.com �פ����ǧ�᡼������ꤷ�ޤ���<br />

������Υ᡼�뤬��ǧ�Ǥ��ʤ������ŵ���������ޤ���Τ�ɬ�����������ǧ�塢<br />
�������ߤ����������Ϥ��ʤ��������ǥ᡼��ե�����򤴳�ǧ������������Ǥ�<br />
�Ϥ��Ƥ��ʤ����Ϻ��٤������ߤϤ��������٥Х�Хꥯ�롼�ޤǤ��䤤��碌����������<br /><br />

<img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

<center><font color="#0066CC">�����������Ƥˤ��ְ㤤�Ϥ������ޤ��󤫡�<br />�����٤���ǧ�ξ塢�������Сֿ�����ץܥ����<font color="#FF0000">���٤���</font>�����Ʋ�������<br /><center>

<img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  <img src="../../../../images/common/dot.gif" width="1" height="20" /><br />
  <center>
  <table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
    <tr>
      <td align="center"><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="������" /><br /><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /></td>
      </tr>
  </table><br />
  <a href="index.php?action=list">&lt;&lt;��������Ӥʤ���</a><br /><a href="index.php?action=input">&lt;�����;����������</a><br />
  </center>
</form>

<img src="../../../../images/common/dot.gif" width="1" height="18" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">��</font></td>
	<td>&nbsp;<a href="../../../../privacy.html"><font color="#000000" size="-1">�Ŀ;����ݸ�����</font></a></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">��</font></td>
	<td>&nbsp;<a href="../../../../index.html"><font color="#000000" size="-1">�ȥåץڡ�����</font></a></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>