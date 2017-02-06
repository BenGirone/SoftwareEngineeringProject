CREATE TABLE Course(
	c_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	//Primary key for each course
	t_id INT NOT NULL,								//forigen key from user.u_id creator of the course
	c_name VARCHAR(25) NOT NULL,					//name of course
	c_desc VARCHAR(100),							//description of course
	date_beg DATE,								//begging date of course
	date_end DATE);									//end date of course