<?php /* Smarty version 2.6.18, created on 2014-11-21 05:45:00
         compiled from shop/sql/item_list_total.sql */ ?>
SELECT count(*) as total FROM itemWHERE d_stamp is null and category_code like 'A0_0'<?php if ($this->_tpl_vars['category_code']): ?> and category_code = '<?php echo $this->_tpl_vars['category_code']; ?>
'<?php endif; ?>;