<?php /* Smarty version 2.6.18, created on 2015-04-17 02:51:14
         compiled from shop/sql/order_list.sql */ ?>
SELECT * FROM "order"WHERE order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
;