<?php /* Smarty version 2.6.18, created on 2015-03-10 12:36:54
         compiled from artist/kubota/login/backstage_2015/input.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/login/backstage_2015/input.html', 37, false),)), $this); ?>
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
		<td align="center"><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /><font color="#FFFFFF">�����;�������</font><br /><img src="../../../../images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

<form  action="index.php" method="post">
  <input type="hidden" name="action" value="confirm" />
  <input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
  
  <?php if ($this->_tpl_vars['errors'] && ! $this->_tpl_vars['errors']['cart']): ?>
  <font color="#FF0000">�����������ܤ򤴳�ǧ����������</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="5" /><br />
  <?php endif; ?>
  <?php if ($this->_tpl_vars['errors']['cart']): ?>
  <font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['cart'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="5" /><br />
  <?php endif; ?>
  
  <font color="#FFCC00">[FC����ֹ�]</font>&nbsp;<font color="#A4272C">��ɬ��</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php if ($this->_tpl_vars['errors']['member_no']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  <input type="text" istyle="4" MODE="numeric" name="data[member_no]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="9" maxlength="8" /><br />
  <font size="1" color="#999999">(�㡧99999999)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
  
  <font color="#FFCC00">[��̾��]</font>&nbsp;<font color="#A4272C">��ɬ��</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php if ($this->_tpl_vars['errors']['name']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  ��&nbsp;<input type="text" name="data[last_name]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
  <font size="1" color="#999999">(�㡧������)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  ̾&nbsp;<input type="text" name="data[first_name]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
  <font size="1" color="#999999">(�㡧����)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
  <?php if ($this->_tpl_vars['errors']['kana']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  ����&nbsp;<input type="text" name="data[last_kana]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['last_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
  <font size="1" color="#999999">(�㡧���ܥ�)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  �ᥤ&nbsp;<input type="text" name="data[first_kana]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['first_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
  <font size="1" color="#999999">(�㡧�ȥ��Υ�)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  
  <font color="#FFCC00">[�᡼�륢�ɥ쥹]</font>&nbsp;<font color="#A4272C">��ɬ��</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php if ($this->_tpl_vars['errors']['mail']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  <input type="text" istyle="3" MODE="alphabet" name="data[mail]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />

  <font color="#FFCC00">[͹���ֹ�]</font>&nbsp;<font color="#A4272C">��ɬ��</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php if ($this->_tpl_vars['errors']['zip']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['zip'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  <input type="text" istyle="4" MODE="numeric" name="data[zip]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['zip'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="7" /><br />
  <font size="1" color="#999999">(�㡧1060031)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
  
  <font color="#FFCC00">[����]</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  ����1&nbsp;<font color="#A4272C">��ɬ��</font><br />
  <?php if ($this->_tpl_vars['errors']['address']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  <input type="text" name="data[pref_city]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['pref_city'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><br />
  <font size="1" color="#999999">(�㡧����Թ���������)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  ����2<br />
  <input type="text" name="data[address]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
  <font size="1" color="#999999">(�㡧1-2-3)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  ����3<br />
  <input type="text" name="data[other_address]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['other_address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
  <font size="1" color="#999999">(�㡧�����ĥޥ󥷥��100�漼)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
    
  <font color="#FFCC00">[Ϣ���������ֹ�]</font>&nbsp;<font color="#A4272C">��ɬ��</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="3" /><br />
  <?php if ($this->_tpl_vars['errors']['tel']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
  <input type="text" istyle="4" MODE="numeric" name="data[tel]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
  <font size="1" color="#999999">(���椴Ϣ��ΤĤ������ֹ�򤪤��줯���������㡧03-1234-5678)</font><br />
  <img src="../../../../images/common/dot.gif" width="1" height="10" /><br />
  
  <img src="../../../../images/common/dot.gif" width="1" height="20" /><br />
  <center>
  <table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
    <tr>
      <td align="center"><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="���Ƥ��ǧ����" /><br /><img src="../../../../images/common/dot.gif" width="1" height="3" /><br /></td>
      </tr>
  </table>
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