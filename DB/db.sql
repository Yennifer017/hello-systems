DROP DATABASE hellosystems;
CREATE DATABASE hellosystems;
USE hellosystems;
CREATE TABLE Moderators(
	id INTEGER,
	username VARCHAR(8) NOT NULL, 
	password VARCHAR(30) NOT NULL,
	CONSTRAINT moderators_pk PRIMARY KEY (id)
);
CREATE TABLE Users(
	id INTEGER,
	username VARCHAR(8) NOT NULL,
	password VARCHAR(30) NOT NULL,
	gold INTEGER NOT NULL DEFAULT 0,
	email VARCHAR(25) NOT NULL,
	CONSTRAINT users_pk PRIMARY KEY  (id)
);

CREATE TABLE Badges(
	id INTEGER,
	name VARCHAR(10) NOT NULL,
	linK VARCHAR(30) NOT NULL,
	CONSTRAINT badges_pk PRIMARY KEY(id)
);

CREATE TABLE Params(
	id INTEGER,
	name VARCHAR(10) NOT NULL,
	value INTEGER NOT NULL,
	CONSTRAINT params_pk PRIMARY KEY (id)
);

CREATE TABLE Depretator(
	id INTEGER,
	atk_base INTEGER DEFAULT 1,
	ps_base INTEGER DEFAULT 1,
	link_img VARCHAR(30) NOT NULL,
	def_name VARCHAR(10) NOT NULL,
	CONSTRAINT depretator_pk PRIMARY KEY (id)
);


CREATE TABLE Plant_potentiator(
	id INTEGER,
	cost INTEGER NOT NULL
);

CREATE TABLE Animals(
	id INTEGER PRIMARY KEY,
	cost INTEGER NOT NULL DEFAULT 0,
	atk_base INTEGER NOT NULL DEFAULT 1,
	ps_base INTEGER NOT NULL DEFAULT 0,
	link_img VARCHAR(30),
	def_name VARCHAR(10) NOT NULL

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
	ID INTEGER PRIMARY KEY,
	id_owner INTEGER NOT NULL,
	date_capture DATE NOT NULL,
	exp INTEGER NOT NULL DEFAULT 0,
	level INTEGER NOT NULL DEFAULT 0,
	id_type INTEGER NOT NULL,
	atack INTEGER NOT NULL DEFAULT 1,
	ps INTEGER NOT NULL DEFAULT 1,
	FOREIGN KEY(id_owner) REFERENCES Users(id),
	FOREIGN KEY(id_type) REFERENCES Animals(id)
);

CREATE TABLE Statistics(
	id INTEGER PRIMARY KEY,
	id_user INTEGER,
	state ENUM('WINNER', 'LOSER', 'INCOMPLEATE') NOT NULL, 
	date DATE NOT NULL,
	points INTEGER NOT NULL,
	gold_gained INTEGER NOT NULL DEFAULT 0,
	id_player INTEGER NOT NULL,
	FOREIGN KEY(id_user) REFERENCES Users(id),
	FOREIGN KEY(id_player) REFERENCES Players_animals(id)
);
