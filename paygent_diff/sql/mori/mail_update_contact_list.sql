select m.mail,od.name,m.end_stamp
from mori_user as m
inner join "order" as o
on m.order_no = o.order_no
inner join "order_desc" as od
on m.order_desc_no = od.order_desc_no
where mail_stamp{$stampNo} like '%{$start}%'
and delete_flg = '0'
and o.d_stamp is null
and od.d_stamp is null;