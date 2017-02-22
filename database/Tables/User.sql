CREATE TABLE user(						//Creation of user table
	f_name VARCHAR(30) NOT NULL,				//First name row
	l_name VARCHAR(30) NOT NULL,				//Last name row
	email VARCHAR(60) NOT NULL UNIQUE,				//email row Alternate Key
	username VARCHAR(30) NOT NULL UNIQUE,				//username to match with during log in Alternate Key
	date_entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,					//date user entered UpGrade
	u_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,		//used to keep track of each user
	password VARCHAR(20) NOT NULL);						//for password