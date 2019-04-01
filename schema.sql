DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
	email text,
	password text,
	admin boolean,
	primary key (email)
);

DROP TABLE IF EXISTS profile CASCADE;
CREATE TABLE profile (
	email text,
	tags text[],
	first_name text,
	last_name text,
	street text,
	state text,
	zip int,
	phone int,
	foreign key (email) references users(email)
);

DROP TABLE IF EXISTS posts CASCADE;
CREATE TABLE posts (
	pid int,
	content text,
	by_email text,
	primary key (pid),
	foreign key (by_email) references users (email)
);

DROP TABLE IF EXISTS comments CASCADE;
CREATE TABLE comments (
	cid int,
	pid int,
	content text,
	index int,
	by_email text,
	on_email text,
	primary key (cid),
	foreign key (by_email) references users (email),
	foreign key (on_email) references users (email),
	foreign key (pid) references posts (pid)
);

DROP TABLE IF EXISTS ratings CASCADE;
CREATE TABLE ratings (
	by_email text,
	on_email text,
	rating int,
	foreign key (by_email) references users (email),
	foreign key (on_email) references users (email)
)
