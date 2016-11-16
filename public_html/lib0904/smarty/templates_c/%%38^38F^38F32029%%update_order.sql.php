<?php /* Smarty version 2.6.18, created on 2014-11-25 16:43:01
         compiled from artist/kubota/ticket_reserve/sql/update_order.sql */ ?>
update "order"
set d_stamp = null
where order_no = <?php echo $this->_tpl_vars['order_no']; ?>
