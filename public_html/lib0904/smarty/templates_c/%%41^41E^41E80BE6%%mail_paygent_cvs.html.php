<?php /* Smarty version 2.6.18, created on 2015-02-27 11:04:59
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/mail_paygent_cvs.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', '/home/funkyjam/public_html/mb/artist/kubota/ticket/mail_paygent_cvs.html', 67, false),)), $this); ?>
<?php echo $this->_tpl_vars['orderDesc']['name']; ?>
 ��<?php $this->assign('total', 0); ?><?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?><?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>
<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>

����ӥ˷�ѡʥ�Х����
<?php echo $this->_tpl_vars['orderDesc']['member_no']; ?>

<?php echo $this->_tpl_vars['orderDesc']['name']; ?>

<?php echo $this->_tpl_vars['orderDesc']['zip']; ?>

<?php echo $this->_tpl_vars['orderDesc']['address1']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address2']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address3']; ?>

<?php echo $this->_tpl_vars['orderDesc']['tel']; ?>

<?php echo $this->_tpl_vars['orderDesc']['mail']; ?>

<?php echo $this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage']; ?>

<?php echo $this->_tpl_vars['orderDesc']['carriage']; ?>

<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<?php echo $this->_tpl_vars['order']['item_code']; ?>

<?php echo $this->_tpl_vars['order']['name']; ?>

<?php echo $this->_tpl_vars['order']['quantity']; ?>

<?php echo $this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']; ?>

<?php endforeach; endif; unset($_from); ?>
<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<?php echo $this->_tpl_vars['order']['item_code']; ?>

<?php echo $this->_tpl_vars['order']['name']; ?>

<?php echo $this->_tpl_vars['order']['quantity']; ?>

<?php echo $this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']; ?>

<?php endforeach; endif; unset($_from); ?>
<?php else: ?>

������ĺ���ޤ���ͭ���񤦤������ޤ�����

����ʧ����ˡ�ϡ֥���ӥ˷�ѡפȤʤ�ޤ���
<?php echo $this->_tpl_vars['convenience_stores'][$this->_tpl_vars['convenience_store_no']]['detail']; ?>


<?php echo $this->_tpl_vars['payment_limit_date']; ?>
23��59�ޤǤˤ���ʧ������������

<?php $_from = $this->_tpl_vars['convenience_store_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<?php echo $this->_tpl_vars['k']; ?>
:<?php echo $this->_tpl_vars['v']; ?>

<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['receipt_print_url']): ?>�ѥ�����ˤƳ�ǧ
<?php echo $this->_tpl_vars['receipt_print_url']; ?>

���ѥ���������᡼�����������ʤɤ��Ƥ����Ѳ�������������������Ϥ��ޤ�ɽ������ޤ���ΤǤ���դ���������<?php endif; ?>

�ܥ᡼��Ϲ���ͽ��Τ���ǧ�᡼��Ȥʤ�ޤ���
�������ߤ��ǧ�Ǥ����衢�������Ƥ����Ȥ����Ƥ��������ޤ���
�������߸塢�����ͤλ���ˤ�륭��󥻥롦�ѹ����ɲá��ֶ�ϡ������ʤ����������ޤ���
���٤ƤΤ��䤤��碌�ˤϡ����������ֹ椬ɬ�פǤ���

�㤪���;����
FC����ֹ桧<?php echo $this->_tpl_vars['orderDesc']['member_no']; ?>

��̾����<?php echo $this->_tpl_vars['orderDesc']['name']; ?>

͹���ֹ桧<?php echo $this->_tpl_vars['orderDesc']['zip']; ?>

���ꡧ<?php echo $this->_tpl_vars['orderDesc']['address1']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address2']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address3']; ?>

Ϣ���������ֹ桧<?php echo $this->_tpl_vars['orderDesc']['tel']; ?>

Email��<?php echo $this->_tpl_vars['orderDesc']['mail']; ?>


�㤪��ʧ����ˡ��
����ӥ˷��


�����ֹ桧<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>


*******************************

<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
����̾��<?php echo $this->_tpl_vars['order']['name']; ?>
<?php if ($this->_tpl_vars['order']['item_code'] == 'KT20130914p'): ?> �ץ�ߥ��ॷ����<?php endif; ?>

���ʡ�<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
�Ŀ���<?php echo $this->_tpl_vars['order']['quantity']; ?>
��

<?php endforeach; endif; unset($_from); ?>
*******************************
<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
����̾��<?php echo $this->_tpl_vars['order']['name']; ?>
<?php if ($this->_tpl_vars['order']['item_code'] == 'KT20130914p'): ?> �ץ�ߥ��ॷ����<?php endif; ?>

���ʡ�<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
�Ŀ���<?php echo $this->_tpl_vars['order']['quantity']; ?>
��

<?php endforeach; endif; unset($_from); ?>
*******************************

<?php if ($this->_tpl_vars['admin'] == 2): ?>
��ס�<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
<?php else: ?>
������<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['paygentCarriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
��Ѽ������<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['paygentFee'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
��ס�<?php echo ((is_array($_tmp=$this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
<?php endif; ?>

*******************************


�㤪�ꤤ�Ȥ��Ǥ��
����ʧ������ˤ������߲�������(��ʧ���¤��ܥ᡼��˵��ܤ��Ƥ���ޤ���)
������ʧ���¤��ڤ줿���ϥ����ƥ�Ǽ�ưŪ�˥���󥻥뤵�졢�������ߤ�̵���Ȥʤ�ޤ���
����׶�ۤˤϥ����å���,������¾�˷�Ѽ����300�ߡ��ǹ��ˤ��դ��ޤ�ޤ���

������åȤΤ��Ϥ��ˤĤ��ơ�
���������߸���������2�������Ǥ��������å�ȯ�������ϡ�����ե��᡼�����ơ��ס����ե������HP�ˤ�
�����Τ餻�פ��ޤ������긵�˥����åȤ��Ϥ����顢ɬ���������������å�����򤴳�ǧ��������
�������������ƤȰۤʤäƤ�����硢��ޥХ�Хꥯ�롼�ˤ�Ϣ��������
���������߸�����10�����ˤʤäƤ�����åȤ��Ϥ��ʤ���硢��ޤ�Ϣ����������
���������Σ������ޤǤˤ�Ϣ��ĺ���ʤ��ä���硢�б��Ǥ��ʤ���ǽ�����������ޤ���
�������åȤϵ����ʤΰ١���ޥȱ�͢�������ƥ����ѥå������ˤƥե��󥯥����Ͽ����ؤ����ꤷ�ޤ���
��͹�ضɤ䡢��ޥȱ�͢�ʤɤ�ž�������ӥ��Ϥ����ѽ���ޤ����ѹ����֤˹�鷺�������줿���ʤɡ�
���������Թ�ˤ���������ʧ���Ȥ�����ĺ���ޤ���


 * *����礪���碌�衡* * *
�����åȤ˴ؤ��뤪���碌�ϡ�
�ե��󥭡���������� �Х�Хꥯ�롼�ؤ��ꤤ�פ��ޤ��� 
TEL��03-3470-7709��ʿ��15:00��18:00�ʳ��ϥ���ե��᡼�����ơ��ס�
e-mail��ticket@funkyjam.com

�����Υ᡼����������ѤǤ���
���ֿ����������Ƥ⤪�������뤳�ȤϽ���ޤ���ΤǤ�λ������������

<?php endif; ?>