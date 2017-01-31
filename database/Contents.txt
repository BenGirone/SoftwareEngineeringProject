CREATE TABLE Assignments(				//table for assignments and grades
	a_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	//id for each assaignment
	tot_points INT NOT NULL,			//total amount of points avalible
	grade_weight INT NOT NULL,			//weight of the assigment in the class
	a_desc VARCHAR(100),				//description of the assaignment
	date TIMESTAMP,					//date assigment is assigned
	grade_given INT,				//grade given by teacher
	date_due DATE,					//date assigment is due
	a_name VARCHAR(30) NOT NULL);			//name of assignment