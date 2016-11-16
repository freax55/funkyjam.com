<?php /* Smarty version 2.6.18, created on 2014-11-25 16:42:59
         compiled from shop/sql/new_order_desc_no.sql */ ?>
SELECT coalesce(max(order_desc_no), 0) + 1 AS new_no FROM order_desc;