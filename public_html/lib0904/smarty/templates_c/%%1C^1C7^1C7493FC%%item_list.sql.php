<?php /* Smarty version 2.6.18, created on 2014-11-21 05:45:00
         compiled from shop/sql/item_list.sql */ ?>
SELECT *FROM itemWHERE d_stamp is null and ( category_code like 'A0_0' )<?php if ($this->_tpl_vars['category_code']): ?> and category_code = '<?php echo $this->_tpl_vars['category_code']; ?>
'<?php endif; ?>ORDER BY to_number(inquiries_tel, '00000')<?php if ($this->_tpl_vars['limit']): ?>	limit <?php echo $this->_tpl_vars['limit']; ?>
 offset <?php echo $this->_tpl_vars['offset']; ?>
<?php endif; ?>;