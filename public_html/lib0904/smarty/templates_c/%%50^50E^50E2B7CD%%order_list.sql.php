<?php /* Smarty version 2.6.18, created on 2014-11-25 16:43:00
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket_reserve/sql/order_list.sql */ ?>
SELECT * FROM "order"WHERE order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
;