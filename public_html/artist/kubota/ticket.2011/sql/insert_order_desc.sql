INSERT INTO order_desc(
	order_desc_no,
	member_no,
	payment,
	name,
	kana,
	zip,
	address1,
	address2,
	address3,
	mail,
	tel,
	carriage,
	d_stamp
) 	
VALUES(
	{$p04},
	'{$member_no}',
	'{$payment}',
	'{$last_name}' || ' ' || '{$first_name}',
	'{$last_kana}' || ' ' || '{$first_kana}',
	'{$zip1}' || '-' || '{$zip2}',
	'{$address1}',
	'{$address2}',
	'{$address3}',
	'{$mail}',
	'{$tel}',
	{$carriageTotal},
	current_timestamp
);
