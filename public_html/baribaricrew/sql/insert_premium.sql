INSERT INTO "premium_users_pc"(
	mail,
	pass,
	insert_stamp,
	start_stamp,
	end_stamp,
	mail_stamp
) 	

VALUES(
	'{$mail}',
	'{$member_no}',
	current_timestamp,
	'{$start}',
	'{$end}',
	'{$start_mail}'
);