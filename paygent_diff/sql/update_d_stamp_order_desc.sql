update order_desc
set d_stamp = null
where order_desc_no = {$order_id}
;