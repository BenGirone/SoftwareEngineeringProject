CREATE TABLE Invite(						/*Table to link users to a teacher built course*/
	i_id INT AUTO_INCREMENT PRIMARY KEY,	/*primary key for invitations*/
	u_id INT NOT NULL,						/*link users to invitations*/
	c_id INT NOT NULL,						/*link courses to invitations*/
	
	
	INDEX (u_id),							/*added on to try to create relationships*/
	FOREIGN KEY (u_id)
		REFERENCES User(u_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	
	INDEX (c_id),						/*added on to try to create relationships*/
	FOREIGN KEY (c_id)
		REFERENCES Course (c_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE);