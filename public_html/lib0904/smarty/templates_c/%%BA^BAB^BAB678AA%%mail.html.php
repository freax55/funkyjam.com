<?php /* Smarty version 2.6.18, created on 2014-11-22 19:14:16
         compiled from /home/funkyjam/public_html/mb/contact/mail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/funkyjam/public_html/mb/contact/mail.html', 29, false),)), $this); ?>
<?php echo $this->_tpl_vars['form']['name']; ?>
 ����

���䤤��碌���ˤ��꤬�Ȥ��������ޤ���
�������̤ꡢ���䤤�礻�򾵤�ޤ����ΤǤ���ǧ����������

�����䤤�礻����
-------------------------------------

[���䤤��碌����]
<?php echo $this->_tpl_vars['form']['type']; ?>


[���䤤��碌����]
<?php echo $this->_tpl_vars['form']['content']; ?>



[��̾��]
<?php echo $this->_tpl_vars['form']['name']; ?>


[�᡼�륢�ɥ쥹]
<?php echo $this->_tpl_vars['form']['mail']; ?>


<?php if ($this->_tpl_vars['form']['sex']): ?>
[�˽�]
<?php echo $this->_tpl_vars['form']['sex']; ?>


<?php endif; ?>
<?php if ($this->_tpl_vars['form']['age']): ?>
[ǯ��]
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['age'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>


<?php endif; ?>
<?php if ($this->_tpl_vars['form']['job']): ?>
[����]
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['job'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>


<?php endif; ?>
-------------------------------------