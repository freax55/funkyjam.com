SELECT uid

FROM premium_users

WHERE uid = '{$uid}'
AND d_stamp IS NULL
;