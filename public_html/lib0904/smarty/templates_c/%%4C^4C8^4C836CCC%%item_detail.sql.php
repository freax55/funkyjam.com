<?php /* Smarty version 2.6.18, created on 2015-02-27 10:55:37
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/sql/item_detail.sql */ ?>
SELECT i.*,
to_char(i.p_date,'YYYY') || '-' || to_char(i.p_date,'MM') || '-01' AS date,
p.name AS place_name,
i.name || ' ' || p.name AS name
FROM item AS i
LEFT JOIN place AS p ON i.place_no = p.place_no
WHERE item_code = '<?php echo $this->_tpl_vars['item_code']; ?>
'
;