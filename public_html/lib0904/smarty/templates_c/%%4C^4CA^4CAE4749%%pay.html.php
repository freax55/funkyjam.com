<?php /* Smarty version 2.6.18, created on 2014-11-21 16:57:33
         compiled from artist/kubota/ticket_reserve/pay.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket_reserve/pay.html', 36, false),array('modifier', 'nl2br', 'artist/kubota/ticket_reserve/pay.html', 84, false),)), $this); ?>
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
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br />����ʧ����ˡ�������<br /><img src="/images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="input" />
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<a name="payment"></a>����ʧ��ˡ��ʲ����餪���Ӥ���������<br />
�ƻ�ʧ��ˡ�ξܺ٤ˤĤ��Ƥ�<a href="#detail">������</a><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<?php if ($this->_tpl_vars['errors']['payment']): ?><font color="#FF0000">��<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['payment'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<!--&nbsp;<input name="payment" type="radio" value="��Х�����FJSHOP BariBariCrewCARD" <?php if ($this->_tpl_vars['payment'] == '��Х�����FJSHOP BariBariCrewCARD'): ?> checked="checked"<?php endif; ?> id="pay03" /><label for="pay03"><font color="#A4272C">[BariBariCrew�����Ď޷��]</font></label><br />
&nbsp;<input name="payment" type="radio" value="��Х�����FJSHOP ����ӥ˷��" <?php if ($this->_tpl_vars['payment'] == '��Х�����FJSHOP ����ӥ˷��'): ?> checked="checked"<?php endif; ?> id="pay04" /><label for="pay04"><font color="#A4272C">[���ݎˎގƷ��]</font></label><br />-->
&nbsp;<input name="payment" type="radio" value="��Х�����FJSHOP ͽ��" checked="checked" id="pay02" /><label for="pay02"><font color="#A4272C">[BARI BARI CREW�����ɷ�ѡ�ͽ���]</font></label><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="�����;������Ϥ�" /><br /><img src="/images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<a name="detail"></a>
��ʧ��ˡ�Τ�����<br />
<!--<img src="/images/common/dot.gif" width="1" height="5" /><br />
<font color="#FF9E23">��</font><a href="#cardBBC">BariBariCrew�����ɷ��</a><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<font color="#FF9E23">��</font><a href="#conveni">����ӥ˷��</a><br />-->
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<font color="#FF9E23">��</font><a href="#yubin">BARI BARI CREW�����ɷ�ѡ�ͽ���</a><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<!--<a name="cardBBC"></a>
<center><font color="#FF9E23">��</font>BariBariCrew�����ɷ��<font color="#FF9E23">��</font></center>
<font size="1">�����ʧ���ΤߤΤ���갷���Ȥʤ�ޤ���<br />
������������ɤ�ͭ�����¤��ڤ�Ƥ����硢��Ѥ�����ޤ���Τ�<font color="#A4272C">�������ߤ�̵��</font>�Ȥʤ�ޤ���<br />
��BARI BARI CREW�����ɷ�ѤˤĤ��ޤ��Ƥϡ������ƥ�塢�������ߴ�λ�����Ǥ���������Ȥ�����ĺ���ޤ�������ղ�������<br />
���������Ƴ�ǧ���̤���¸����뤳�Ȥ򤪴����פ��ޤ���<br /></font>
<div align="right"><a href="#payment">������ʧ����ˡ�����</a></div>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<a name="conveni"></a>
<center><font color="#FF9E23">��</font>����ӥ˷��<font color="#FF9E23">��</font></center>
<font size="1">������ʧ�����������륳��ӥ˥��󥹥��ȥ�<br />
���֥󥤥�֥󡦥����󡦥ե��ߥ꡼�ޡ��ȡ����������ޡ��ȡ���������K���󥯥����ǥ��꡼��ޥ����ʥ�ޥ����ǥ��꡼���ȥ���������꡼��<br />
<br />
������ӥ˥��󥹥��ȥ�����Τ������ǧ�塢������λ�Ȥʤ�ޤ���<br />
����ʧ������ˤ������߲�������<br />
����ʧ���¤��ڤ줿���ϥ����ƥ�Ǽ�ưŪ�˥���󥻥뤵�졢<font color="#A4272C">�������ߤ�̵��</font>�Ȥʤ�ޤ���<br />
����ʧ�����ְ㤨�ޤ���<font color="#A4272C">�����åȤϤ��Ѱս���ޤ���</font>��<br />
��������׶�ۡʥ����å���������ˤ�¾�˷�Ѽ��������ɬ�פǤ���<br />
����Ѽ�����ξܺ٤ϡ�<a href="attention.html#06">��Ѽ�����ˤĤ���</a>�פ򤴳�ǧ��������<br />
�����ѿ����ѻ�������פ��Ƥ���ޤ���<br />
���������Ƴ�ǧ���̵ڤӿ����ߴ�λ���̤���¸����뤳�Ȥ򤪴����פ��ޤ���<br />
<?php $_from = $this->_tpl_vars['units']['convenience_stores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['n']['iteration']++;
?>
<a name="convenience_store_<?php echo $this->_tpl_vars['k']; ?>
_detail"></a>
<font color="#FF9E23">��</font><?php echo $this->_tpl_vars['v']['name']; ?>
<br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['detail'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php endforeach; endif; unset($_from); ?>
</font>-->

<a name="yubin"></a>
<center><font color="#FF9E23">��</font>BARI BARI CREW�����ɷ�ѡ�ͽ���<font color="#FF9E23">��</font></center>
<font size="1">
*�������Ƴ�ǧ�᡼�뤬��ư�ۿ�����ޤ���<br />
���㡧2���餪�����ߤξ�硢�������Ƴ�ǧ�᡼���2���Ϥ��ޤ�����<strong>ɬ�����٤ƤΥ᡼��򤴳�ǧ����������</strong><br />
<strong>�������åȤι���������3,000��ʬ������դ������ʤ������оݤˤʤ�٤ˤ�<font color="#FF0000">2014ǯ1��10���ޤ�</font>��BARI BARI CREW CARD��ȯ�Ԥ���Ƥ��뤳�Ȥ����Ǥ���</strong><br />
�����ʧ���ΤߤΤ���갷���Ȥʤ�ޤ���<br />
������������ɤ�ͭ�����¤��ڤ�Ƥ����硢��Ѥ�����ޤ���Τ�<b>�������ߤ�̵��</b>�Ȥʤ�ޤ���<br />
��BARI BARI CREW�����ɷ�ѡ�ͽ��ˤˤĤ��ޤ��Ƥϡ��������ߴ�λ�塢BARI BARI CREW�����ɤ�ȯ�Ԥ��줿�����Ǥ���������Ȥ�����ĺ���ޤ���<br />
�������åȤ��������߸塢���մ�����˥����ɤ�ȯ�Ԥ��줿��硢���ټ�³����ɬ�פϤ������ޤ���<br />
��2014ǯ1��10���ޤǤ�BARI BARI CREW�����ɤ�ȯ�Ԥ���ʤ��ä���硢���Ӥ���ʧ����ˡ�򤴰��⤵���Ƥ��������ޤ��������ä�᡼��ˤƤ��Τ餻�������ޤ��Τ�ɬ��Ϣ��ΤĤ���Ϣ��������Ϥ�������<br />
���������Ƴ�ǧ���̤���¸����뤳�Ȥ򤪴����פ��ޤ���<br />
</font>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<!--<a name="atm"></a>
<center><font color="#FF9E23">��</font>ATM���<font color="#FF9E23">��</font></center>
<font size="1">�ڥ������ޡ����Τ���ATM�ˤƤ���ʧ��ĺ���ޤ���<br />
�����ߴ�λ�����������ޤ��������Ƴ�ǧ�᡼�뵭�ܤΡּ�Ǽ�����ֹ�ס֤������ֹ�סֳ�ǧ�ֹ�פ��⤷�ơ������ζ�Ԥ�ATM�عԤ�������ʧ����������<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
������ʧ��������������<br />
�椦�����ԡ����潻ͧ��ԡ��ꤽ�ʶ�ԡ���̤ꤽ�ʶ�ԡ����ն�ԡ����ն�ԡ��ߤ��۶��<br />
<br />
��ATM����Τ������ǧ�塢������λ�Ȥʤ�ޤ���<br />
����ʧ������ˤ������߲�������(��ʧ���¤Ϲ������Ƴ�ǧ�᡼��˵��ܤ��Ƥ���ޤ���)<br />
����ʧ���¤��ڤ줿���ϥ����ƥ�Ǽ�ưŪ�˥���󥻥뤵�졢<font color="#A4272C">�������ߤ�̵��</font>�Ȥʤ�ޤ���<br />
��ʣ�����餪�����ߤξ�硢<font color="#A4272C">��ʧ����ɬ�פ��ֹ�Ϥ���������˰ۤʤ�ޤ�</font>��1�鷺�Ĥ���ʧ������������ʧ�����ְ㤨�ޤ���<font color="#A4272C">�����åȤϤ��Ѱս���ޤ���</font>��<br />
��������׶�ۡʥ����å���������ˤ�¾�˷�Ѽ��������ɬ�פǤ���<br />
����Ѽ�����ξܺ٤ϡ�<a href="attention.html#06">��Ѽ�����ˤĤ���</a>�פ򤴳�ǧ��������<br />
���������Ƴ�ǧ���̵ڤӿ����ߴ�λ���̤���¸����뤳�Ȥ򤪴����פ��ޤ���<br />

</font>-->
<div align="right"><a href="#payment">������ʧ����ˡ�����</a></div>
<img src="/images/common/dot.gif" width="1" height="10" /><br />

</form>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
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
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>