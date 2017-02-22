UPDATE `upGrade`.`User`
SET f_name = 'Entered by user, or stays the same', 
	l_name = 'Entered by user, or stays the same',
	email = 'Entered by user, or stays the same',
	username = 'Entered by user, or stays the same',
	password = 'Entered by user, or stays the same'
WHERE u_id = "value of users id";