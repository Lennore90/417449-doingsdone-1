USE doingsdone;

CREATE TABLE users (
	id INT AUTO_INCREMENT  PRIMARY KEY,
	reg_date DATE,
	email TEXT,
	name TEXT,
	password TEXT,
	contact_info TEXT,
);

CREATE TABLE projects (
	id INT AUTO_INCREMENT  PRIMARY KEY,
	name TEXT,
	user_id INT,
);

CREATE TABLE tasks (
	id INT AUTO_INCREMENT  PRIMARY KEY,
	name TEXT,
	assign_date DATE,
	deadline DATE,
	completed DATE,
	file_link TEXT,
	user_id INT,
	project_id INT,
);

CREATE UNIQUE INDEX email ON users(email);
