UPDATE `upgrade`.`Assignments`
SET p_id = 'new parent id',
	c_id = 'new course id',
	grade_given = 'new grade',
	grade_weight = 'new weight',
	a_desc = 'new assignment description',
	date_assigned = 'new assignment date',
	date_due = 'new due date',
	a_name = 'new assignment name'
WHERE a_id = 'assignment changing id';