CREATE TABLE Assignments(							/*table for assignments and grades*/
	a_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	/*id for each assaignment*/
	p_id INT,										/*possible id to link assigments to other assaignments*/
	c_id INT NOT NULL,								/*forigen key to classes*/
	grade_weight INT,						/*weight of the assigment in the course*/
	a_desc VARCHAR(500),							/*description of the assaignment*/
	date_assigned DATE,								/*date assigment is assigned*/
	date_due DATE,									/*date assigment is due*/
	a_name VARCHAR(30) NOT NULL,					/*name of assignment*/
	
	
	INDEX (c_id),					/*added on to try to create relationships*/
	FOREIGN KEY (c_id)
		REFERENCES Course(c_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE);
		
	
	/*changes on 2/13: took out grade_given and made a new table for it, changed grade_weight allowing null, changed description to 500