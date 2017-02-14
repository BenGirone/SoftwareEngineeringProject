CREATE TABLE GradeGiven(
	gg_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,		//primary key for each grade given
	a_id INT NOT NULL,									//assignment link to grades
	u_id INT NOT NULL,									//user link to grades
	grade_given INT NOT NULL DEFAULT -1,				//grade, defaults to -1 meaning empty
	
	
	INDEX (a_id),										//links a_id to assignments
	FOREIGN KEY (a_id)
		REFERENCES Assignments (a_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
		
	INDEX (u_id),										//links u_id to user
	FOREIGN KEY (u_id)
		REFERENCES User (u_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE)