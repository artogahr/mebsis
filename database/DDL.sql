DROP DATABASE socialnetwork;
CREATE DATABASE socialnetwork;

CREATE TABLE users (
	nationalID int(11) not null,
	id int(6) not null auto_increment;
	nameSurname varchar(40);
	phone int(11),
	mail varchar(40),
	password varchar(20), 
	currentEmployer varchar(40),
	position varchar(40),
	workSector varchar(40),
	bachelorUni varchar(40),
	masterUni varchar(40),
	doctorateUni varchar(40),
	foreignLanguage varchar(40),
	certificate varchar(40),
	pastWorkID int(11),
	userType varchar(7),
	graduationDate date,
	gender varchar(6)
	PRIMARY KEY (id)
);

CREATE TABLE companies (
	companyName varchar(40) not null auto_increment,
	phone int(11),
	mail varchar(40),
	adress varchar(50),
	workSector varchar(15)
);

CREATE TABLE messages (
	senderID int(6) not null,
	receiverID int(6) not null,
	mesageID int(6) not null primary key auto_increment,
	content text,
	sentDate date,
	PRIMARY KEY(messageID),
	FOREIGN KEY(senderID) REFERENCES students(id),
	FOREIGN KEY(receiverID) REFERENCES students(id)
);

CREATE TABLE friendship (
	user1_id            INT NOT NULL,
	user2_id            INT NOT NULL,
	friendship_status   INT NOT NULL,
	FOREIGN KEY (user1_id) REFERENCES users(user_id),
	FOREIGN KEY (user2_id) REFERENCES users(user_id)
);

CREATE TABLE posts (
	id             INT NOT NULL AUTO_INCREMENT,
	time           date NOT NULL, 
	user             INT NOT NULL,
	companyName	varchar(50),
	public         CHAR(1) NOT NULL,
	announcementType varchar(10),
	deadline date not null,
	internshipTerm varchar(10),
	startDate date not null,
	endDate date not null,
	PRIMARY KEY (id),
	FOREIGN KEY (user) REFERENCES students(id)
);

CREATE TABLE user_phone (
	user_id         INT,
	user_phone      INT,
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);
