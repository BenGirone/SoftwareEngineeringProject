CREATE TABLE student(						//Creation of Student table
	f_name VARCHAR(30) NOT NULL,				//First name row
	l_name VARCHAR(30) NOT NULL,				//Last name row
	email VARCHAR(60) NOT NULL,				//email row
	username VARCHAR(30) NOT NULL,				//username to match with during log in
	date_entered TIMESTAMP,					//date user entered UpGrade
	s_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY);		//used to keep track of each user