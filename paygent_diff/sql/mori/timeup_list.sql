select account_no
from mori_user
where end_stamp like '%{$start}%'
and delete_flg = '0'