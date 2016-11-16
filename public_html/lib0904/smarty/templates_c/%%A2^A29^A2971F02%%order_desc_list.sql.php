<?php /* Smarty version 2.6.18, created on 2015-04-17 02:51:14
         compiled from shop/sql/order_desc_list.sql */ ?>
SELECT * FROM order_descWHERE order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
;