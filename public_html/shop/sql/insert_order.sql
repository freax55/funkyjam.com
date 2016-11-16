INSERT INTO "order"(
	order_no,
	order_desc_no,
	item_code,
	category_code,
	name,
	color,
	size,
	price,
	quantity,
	d_stamp
) 	
VALUES(
	(SELECT coalesce(max(order_no), 0) + 1 FROM "order"),
	{$p04},
	'{$item.item_code}',
	'{$itemList[$item.item_code].category_code}',
	'{$itemList[$item.item_code].name}',
	'{$itemList[$item.item_code].color}',
	'{$itemList[$item.item_code].size}',
	'{$itemList[$item.item_code].price}',
	'{$item.quantity}',
	current_timestamp
);
