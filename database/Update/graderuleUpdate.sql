UPDATE `upgrade`.`graderule`
SET c_id = 'new course',
	grade_letter = 'new grade letter',
	g_value = 'new value'
WHERE gr_id = 'id of graderule to change';