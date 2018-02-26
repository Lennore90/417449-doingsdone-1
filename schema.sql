USE doingsdone;

CREATE TABLE users (
	reg_date DATE,
	email TEXT PRIMARY KEY,
	name TEXT,
	password TEXT,
	contact_info TEXT,
);

CREATE TABLE projects (
	id INT AUTO_INCREMENT,
	name TEXT PRIMARY KEY,
	user TEXT,
);

CREATE TABLE tasks (
	id INT AUTO_INCREMENT,
	name TEXT PRIMARY KEY,
	assign_date DATE,
	deadline DATE,
	completed DATE,
	file_link TEXT,
	user TEXT,
	project TEXT,
);

CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX name ON projects(name);
CREATE UNIQUE INDEX id ON tasks(id);

CREATE INDEX contact_info ON users(contact_info);
CREATE INDEX user ON projects(user);
CREATE INDEX deadline ON tasks(deadline);
CREATE INDEX completed ON tasks(completed);
CREATE INDEX file_link ON tasks(file_link);
CREATE INDEX user ON tasks(user);
CREATE INDEX project ON tasks(project);
