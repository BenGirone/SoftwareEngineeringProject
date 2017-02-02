CREATE TABLE Teacher(					//teacher table
	t_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	//primary key for linking teachers to their classes
	f_name VARCHAR(30) NOT NULL,			//first name
	l_name VARCHAR(30) NOT NULL,			//last name
	date_joined TIMESTAMP,				//date teacher joined the app
	t_email VARCHAR(60) NOT NULL);			//email for notifications or student email teacher
	/*t_phone CHAR(20));*/				//phone optional for notifications pushed to phone text?