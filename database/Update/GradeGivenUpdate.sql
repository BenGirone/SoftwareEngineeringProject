UPDATE `upGrade`.`GradeGiven`
SET a_id = 'new assignment id',
	u_id = 'new users id',
	grade_given = 'new grade'
WHERE gg_id = 'id of given grade to change';