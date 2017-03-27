CREATE TABLE graderule(							/*table for grade weights*/
	gr_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	/*primary key*/
	c_id INT NOT NULL,								/*foreign key from course*/
	grade_letter CHAR(4) NOT NULL,					/*for grade letter itself*/
	g_value DEC(5,3) NOT NULL,						/*decimal value that can be turned into percent for grades*/
	
	INDEX (c_id),									/*setting up foreign key*/
	FOREIGN KEY (c_id)
		REFERENCES course(c_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE);