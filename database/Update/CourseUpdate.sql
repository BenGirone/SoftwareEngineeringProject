UPDATE `upgrade`.`Course`
SET	t_id = 'new creator of course',
	c_name = 'new name of course',
	c_desc = 'new description of course',
	date_beg = 'new begging date of course',
	date_end = 'new ending date of course'
WHERE c_id = 'id of course being modifiyed';