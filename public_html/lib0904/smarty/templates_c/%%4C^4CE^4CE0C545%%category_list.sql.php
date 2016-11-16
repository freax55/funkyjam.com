<?php /* Smarty version 2.6.18, created on 2016-03-01 18:23:44
         compiled from shop/sql/category_list.sql */ ?>
SELECT c.category_code, c.name, count(*) as itemsFROM category as c, item as iWHERE i.d_stamp is nulland c.d_stamp is nulland c.kind = 'goods'and c.category_code = i.category_codegroup by c.category_code, c.nameorder by c.category_code;