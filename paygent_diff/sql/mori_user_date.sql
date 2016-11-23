select * 
from mori_user
where order_desc_no = {$order_id}
and u_order_desc_no is null;