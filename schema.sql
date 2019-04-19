DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
	email text,
	password text,
	primary key (email)
);

DROP TABLE IF EXISTS profile CASCADE;
CREATE TABLE profile (
	email text,
	first_name text,
	last_name text,
	foreign key (email) references users(email)
);

DROP TABLE IF EXISTS tag CASCADE;
CREATE TABLE tag (
	tag text,
	tagid int,
	primary key(tagid)
);

DROP TABLE IF EXISTS posts CASCADE;
CREATE TABLE posts (
	pid int,
	content text,
	email text,
	tagid int,
	isresolved boolean,
	address text,
	starttime text,
	endtime text,
	primary key (pid),
	foreign key (email) references users (email),
	foreign key (tagid) references tag (tagid)

);

DROP TABLE IF EXISTS comments CASCADE;
CREATE TABLE comments (
	cid int,
	pid int,
	content text,
	index int,
	email_from text,
	primary key (cid),
	foreign key (email_from) references users (email),
	foreign key (pid) references posts (pid)
);

DROP TABLE IF EXISTS ratings CASCADE;
CREATE TABLE ratings (
	email_from text,
	email_on text,
	rating int,
	pid int,
	foreign key (email_from) references users (email),
	foreign key (email_on) references users (email),
	foreign key (pid) references posts (pid)
);



DROP TABLE IF EXISTS bid CASCADE;
CREATE TABLE bid (
	email_from text,
	bidid int,
	pid int,
	amount float,
	primary key(bidid),
	foreign key (email_from) references users (email),
	foreign key (pid) references posts (pid)
);
