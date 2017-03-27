CREATE TABLE user(										/*Creation of user table*/
	email VARCHAR(60) NOT NULL UNIQUE,					/*email row Alternate Key */
	username VARCHAR(30) NOT NULL UNIQUE,				/*username to match with during log in Alternate Key*/
	date_entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,	/*date user entered upgrade*/
	u_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,		/*used to keep track of each user*/
	password VARCHAR(20) NOT NULL,						/*keep password for future reference*/
	registrationCode VARCHAR(60) NOT NULL,				/*sends code to email*/
	is_registered BIT DEFAULT 0);						/*helps make sure a user is conected through email*/