select start_stamp,end_stamp,mail_stamp1,mail_stamp2,mail_stamp3 from mori_user
WHERE account_no = '{$account_no}'
and delete_flg = 0;