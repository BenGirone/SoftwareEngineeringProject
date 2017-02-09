CREATE TABLE Assignments(							//table for assignments and grades
	a_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	//id for each assaignment
	p_id INT,										//possible id to link assigments to other assaignments
	c_id INT NOT NULL,								//forigen key to classes
	grade_given DOUBLE,								//grade given by teacher
	grade_weight INT NOT NULL,						//weight of the assigment in the course
	a_desc VARCHAR(100),							//description of the assaignment
	date_assigned DATE,								//date assigment is assigned
	date_due DATE,									//date assigment is due
	a_name VARCHAR(30) NOT NULL,					//name of assignment
	
	
	INDEX (c_id),					//added on to try to create relationships
	FOREIGN KEY (t_id)
		REFERENCES Course(c_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE);