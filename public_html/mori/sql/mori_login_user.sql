select m.*,od.payment from mori_user as m
inner join "order" as o
on m.order_no = o.order_no
inner join "order_desc" as od
on m.order_desc_no = od.order_desc_no
where m.account_no = '{$login_id}'
and m.delete_flg = '0';