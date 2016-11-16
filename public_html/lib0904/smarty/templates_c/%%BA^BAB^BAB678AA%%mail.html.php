<?php /* Smarty version 2.6.18, created on 2014-11-22 19:14:16
         compiled from /home/funkyjam/public_html/mb/contact/mail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/funkyjam/public_html/mb/contact/mail.html', 29, false),)), $this); ?>
<?php echo $this->_tpl_vars['form']['name']; ?>
 さま

お問い合わせ誠にありがとうございます。
下記の通り、お問い合せを承りましたのでご確認ください。

▼お問い合せ内容
-------------------------------------

[お問い合わせ種別]
<?php echo $this->_tpl_vars['form']['type']; ?>


[お問い合わせ内容]
<?php echo $this->_tpl_vars['form']['content']; ?>



[お名前]
<?php echo $this->_tpl_vars['form']['name']; ?>


[メールアドレス]
<?php echo $this->_tpl_vars['form']['mail']; ?>


<?php if ($this->_tpl_vars['form']['sex']): ?>
[男女]
<?php echo $this->_tpl_vars['form']['sex']; ?>


<?php endif; ?>
<?php if ($this->_tpl_vars['form']['age']): ?>
[年齢]
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['age'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>


<?php endif; ?>
<?php if ($this->_tpl_vars['form']['job']): ?>
[職業]
<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['job'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>


<?php endif; ?>
-------------------------------------