update "order"
set d_stamp = null
where order_desc_no = {$order_id}
;