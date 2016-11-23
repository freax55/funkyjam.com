select m.mail,od.name
from mori_user as m
inner join "order" as o
on m.order_no = o.order_no
inner join "order_desc" as od
on m.order_desc_no = od.order_desc_no
where birth_month = '{$month}'
and birth_day = '{$day}'
and delete_flg = '0'
and o.d_stamp is null
and od.d_stamp is null;