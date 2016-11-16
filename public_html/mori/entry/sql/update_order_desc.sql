update order_desc
set d_stamp = null,
	settlement_no = '{$settlement_no}',
	recognition_no = '{$recognition_no}'
where order_desc_no = {$order_desc_no}
