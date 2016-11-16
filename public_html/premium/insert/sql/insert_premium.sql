INSERT INTO "premium_users_pc"(
	mail,
	pass,
	insert_stamp,
	start_stamp,
	end_stamp,
	mail_stamp,
	order_no,
	order_desc_no
) 	

VALUES(
	'{$mail}',
	'{$member_no}',
	current_timestamp,
	'{$start}',
	'{$end}',
	'{$start_mail}',
	'{$order_no}',
	'{$order_desc_no}'
);