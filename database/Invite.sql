CREATE TABLE Invite(						//Table to link users to a teacher built course
	i_id INT AUTO_INCREMENT PRIMARY KEY,	//primary key for invitations
	u_id INT NOT NULL,						//link users to invitations
	c_id INT NOT NULL);						//link courses to invitations