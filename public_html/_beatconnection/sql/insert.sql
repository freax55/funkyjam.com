INSERT INTO "ticket_entry"(
	member_no,
	name,
	mail,
	quantity,
	tel,
	c_stamp
)
VALUES(
	'{$form.member_no}',
	'{$form.name}',
	'{$form.mail}',
	'{$form.quantity}',
	'{$form.tel}',
	current_timestamp
);
