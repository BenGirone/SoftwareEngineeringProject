UPDATE `upgrade`.`user`									/*for changing values in user, if a value isnt to be changed keep it the same*/
SET email = 'Entered by user, or stays the same',		/*change email*/
	username = 'Entered by user, or stays the same',	/*change username*/
	password = 'Entered by user, or stays the same',	/*change password*/
	is_registered = '1 for yes and 0 for no'			/*change if registered*/
WHERE u_id = "value of users id";						/*specific users account to change*/