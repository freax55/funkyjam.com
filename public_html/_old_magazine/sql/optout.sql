UPDATE "magazine"
SET
	d_stamp = current_timestamp
WHERE
	account_no = {$account_no}
;
