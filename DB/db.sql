DROP DATABASE hellosystems;
CREATE DATABASE hellosystems;
USE hellosystems;
CREATE TABLE Moderators(
	id INTEGER AUTO_INCREMENT,
	username VARCHAR(8) NOT NULL, 
	password VARCHAR(65) NOT NULL,
	CONSTRAINT moderators_pk PRIMARY KEY (id)
);
CREATE TABLE Users(
	id INTEGER AUTO_INCREMENT,
	username VARCHAR(8) NOT NULL UNIQUE,
	password VARCHAR(65) NOT NULL,
	gold INTEGER NOT NULL DEFAULT 0,
	email VARCHAR(25) NOT NULL UNIQUE,
	CONSTRAINT users_pk PRIMARY KEY  (id)
);

CREATE TABLE Badges(
	id INTEGER AUTO_INCREMENT,
	name VARCHAR(10) NOT NULL,
	linK VARCHAR(30) NOT NULL,
	CONSTRAINT badges_pk PRIMARY KEY(id)
);

CREATE TABLE Params(
	id INTEGER AUTO_INCREMENT,
	name VARCHAR(10) NOT NULL,
	value INTEGER NOT NULL,
	CONSTRAINT params_pk PRIMARY KEY (id)
);

CREATE TABLE Depretator(
	id INTEGER AUTO_INCREMENT,
	atk_base INTEGER DEFAULT 1,
	ps_base INTEGER DEFAULT 1,
	link_img VARCHAR(30) NOT NULL,
	def_name VARCHAR(10) NOT NULL,
	difficult ENUM('EASY', 'MEDIUM', 'HARD'),
	CONSTRAINT depretator_pk PRIMARY KEY (id)
);


CREATE TABLE Plant_potentiator(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	cost INTEGER NOT NULL,
	exp INTEGER NOT NULL DEFAULT 0,
	ps INTEGER NOT NULL DEFAULT 0,
	atk INTEGER NOT NULL DEFAULT 0,
	name VARCHAR(10),
	link_img VARCHAR(30)
);

CREATE TABLE Animals(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	cost INTEGER NOT NULL DEFAULT 0,
	atk_base INTEGER NOT NULL DEFAULT 1,
	ps_base INTEGER NOT NULL DEFAULT 0,
	link_img VARCHAR(30),
	def_name VARCHAR(10) NOT NULL UNIQUE

);

CREATE TABLE Gained_badges(
	id_user INTEGER,
	id_badge INTEGER,
	data DATE,
	CONSTRAINT gained_badges_pk PRIMARY KEY(id_user, id_badge),
        FOREIGN KEY(id_user) REFERENCES Users(id),
	FOREIGN KEY(id_badge) REFERENCES Badges(id)	
);
CREATE TABLE Players_animals(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_owner INTEGER NOT NULL,
	date_capture DATE NOT NULL,
	exp INTEGER NOT NULL DEFAULT 0,
	level INTEGER NOT NULL DEFAULT 0,
	id_type INTEGER NOT NULL,
	atack INTEGER NOT NULL DEFAULT 1,
	ps INTEGER NOT NULL DEFAULT 1,
	alias VARCHAR(10) NOT NULL,
	FOREIGN KEY(id_owner) REFERENCES Users(id),
	FOREIGN KEY(id_type) REFERENCES Animals(id)
);

CREATE TABLE Statistics(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	id_user INTEGER,
	state ENUM('WINNER', 'LOSER', 'INCOMPLEATE') NOT NULL, 
	date DATE NOT NULL,
	points INTEGER NOT NULL,
	gold_gained INTEGER NOT NULL DEFAULT 0,
	id_player INTEGER NOT NULL,
	id_depretator INTEGER NOT NULL,
	FOREIGN KEY(id_user) REFERENCES Users(id),
	FOREIGN KEY(id_player) REFERENCES Players_animals(id),
	FOREIGN KEY(id_depretator) REFERENCES Depretator(id)
);
