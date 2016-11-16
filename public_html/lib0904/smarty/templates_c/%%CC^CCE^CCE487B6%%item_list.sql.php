<?php /* Smarty version 2.6.18, created on 2015-02-27 10:56:17
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/sql/item_list.sql */ ?>
SELECT i.*,
to_char(i.p_date,'YYYY') || '-' || to_char(i.p_date,'MM') || '-01' AS date,
p.name AS place_name,
i.name || ' ' || p.name AS name
FROM item AS i
LEFT JOIN place AS p ON i.place_no = p.place_no
WHERE category_code = 'A011'
<?php if ($this->_tpl_vars['date']): ?>
AND to_char(i.p_date,'YYYY-MM-01') = '<?php echo $this->_tpl_vars['date']; ?>
'
<?php endif; ?>
ORDER BY p_date
;