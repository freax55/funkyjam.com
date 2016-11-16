SELECT c.category_code, c.name, count(*) as items
FROM category as c, item as i
WHERE i.d_stamp is null
and c.d_stamp is null and ( c.category_code like 'A0_0' )
and c.kind = 'goods'
and c.category_code = i.category_code
group by c.category_code, c.name
order by c.category_code
;