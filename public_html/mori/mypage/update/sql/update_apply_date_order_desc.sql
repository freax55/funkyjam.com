update order_desc
set apply_date = current_timestamp
where order_desc_no = {$order_desc_no}
