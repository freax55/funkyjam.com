select p.mail
from premium_users_pc as p
inner join "order" as o
on p.order_no = o.order_no
inner join "order_desc" as od
on p.order_desc_no = od.order_desc_no
where delete_flg = '0'
and o.d_stamp is null
and od.d_stamp is null;