<?php /* Smarty version 2.6.18, created on 2015-04-23 20:24:31
         compiled from shop/mail_substitution.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'shop/mail_substitution.html', 46, false),array('modifier', 'number_format', 'shop/mail_substitution.html', 47, false),)), $this); ?>
<?php echo $this->_tpl_vars['orderDesc']['name']; ?>
 ��<?php $this->assign('total', 0); ?><?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?><?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>
<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>

�������ʥ�Х����
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
����ʧ����ˡ�ϡ��������פȤʤ�ޤ���
���ʤ��Ϥ����ˡ����ʤ����+\1,000(����������ȯ��������)�򸽶�Ǥ���ʧ������������
������ʧ����ˡ�ϡָ���ΤߡפȤʤäƤ���ޤ���ͽ�ᤴλ������������
�������������Ƥ˸�꤬���ä����ϡ���������������������˥᡼��ˤƤ�Ϣ��������
������ˤ�Ϣ���ʤ������ǡ����������ߴ�λ�Ȥʤ�ޤ���
���ʤ����긵���Ϥ��ޤ����顢�������ˤƤ���ʧ����������

�������Υ᡼��ϡ������ͤΤ����������ˤ�ʤ�ޤ��Τǡ���������ޤ����ڤ��ݴɤ��Ƥ���������



�㤪��ʧ����ˡ��
������
�����ֹ桧<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>


***************
<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
����̾��<?php echo $this->_tpl_vars['order']['name']; ?>

����<?php echo $this->_tpl_vars['order']['color']; ?>

��������<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['size'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp, false) : smarty_modifier_strip_tags($_tmp, false)); ?>

���ʡ�<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
�Ŀ���<?php echo $this->_tpl_vars['order']['quantity']; ?>
��
<?php endforeach; endif; unset($_from); ?>
***************

<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
����̾��<?php echo $this->_tpl_vars['order']['name']; ?>

����<?php echo $this->_tpl_vars['order']['color']; ?>

��������<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['size'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp, false) : smarty_modifier_strip_tags($_tmp, false)); ?>

���ʡ�<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
�Ŀ���<?php echo $this->_tpl_vars['order']['quantity']; ?>
��
<?php endforeach; endif; unset($_from); ?>
***************
<?php if ($this->_tpl_vars['admin'] == 2): ?>
��ס�<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
<?php else: ?>
������<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
��ס�<?php echo ((is_array($_tmp=$this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
<?php endif; ?>
***************

�㤪�ꤤ�Ȥ��Ǥ��
�����ʤΥ�����,��,��������褯����ǧ�ξ塢���������߲��������������������ߴ�λ��ξ��ʤθ�/����/�������ѹ��ϸ�§Ū�˼����դ��Ƥ���ޤ���ΤǤ�λ������������
����§Ū�ˤ��������߸�Υ���󥻥롦���ֶ�Ϥ���������ޤ���Τ�ͽ�ᤴλ����������
���ۡ���ڡ����˷Ǻܤ���Ƥ���̿��ȼºݤξ��ʤȤǤϡ��㴳�κ��������ǽ�����������ޤ�����λ����������
�����ʤϿ��˸¤꤬�������ޤ�������˾��ź���ʤ����⤴�����ޤ�����λ����������
�����̤������Ϥ������פ����ͤޤ���
������̤�����Υȥ�֥���н褷�䤹���褦�����ҤǤ������ؤ�ȤäƤ���ޤ������ʤ��羮�˴ؤ�餺Ʊ�ۤ��������Χ��1,000�Ȥ���ĺ���ޤ������ɤ�����λ����������
�����Ϥ��������ʤ����������ʤȰۤʤä��ꡢ��»�����Ƥ������ϡ����������8������˲������䤤�礻��ؤ����ä⤷���ϥ᡼��ˤƤ�Ϣ��������

�㾦�ʤΤ��Ϥ��ˤĤ��ơ�
�����ʤ����긵���Ϥ��ޤǺ���4������������ޤ���ͽ�ᤴλ����������
���������������Ƥ����������硢ȯ�����٤�ޤ�������ղ��������ޤ��������߸�˽�����ѹ����줿���Ϥ��ߤ䤫�˲����Τ��䤤��碌��ޤǤ�Ϣ��������
���������߻��Τ�����������ؤˤƤ��Ϥ��פ��ޤ��Τǡ���α��ξ��ϡ��Ժ�����ɼ�פ˽�����������겼�������Ժ�����ɼ��ȡ�塢�����ͤ������۶ȼԤغ���ã�δ�˾Ϣ���ʤ��ä���硢�����ͤ������߻��˵������줿���꤬�����Ƥ��ä���硢�����ѹ���Ϣ���ʤ���ã����ʤ��ä�������ͳ�ǡ����ʤ�ȯ�������������줿��硢��ȯ�������1000�ߤϤ����ͤΤ���ô�Ȥ����Ƥ��������ޤ��Τǡ�ͽ�ᤴλ����������

�����Υ᡼����������ѤǤ���
�ֿ����������Ƥ⤪�������뤳�ȤϽ���ޤ���ΤǤ�λ������������

*����礪���碌�衡*
���ʤ˴ؤ��뤪���碌�ϡ��ե��󥭡���������� FJ SHOP���ؤ��ꤤ�פ��ޤ���
TEL��03-3470-7707��ʿ��10:30��18��30��
e-mail��shop@funkyjam.com
<?php endif; ?>
