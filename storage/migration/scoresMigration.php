<?php

// create table scores
return '
CREATE TABLE IF NOT EXISTS "scores" (
	"id_user" INTEGER,
	"id_level" INTEGER,
	"level"	VARCHAR(255) NOT NULL,
	"coints" INTEGER DEFAULT 0,
	"stars"	INTEGER DEFAULT 0,
	"time"	VARCHAR(255),
	PRIMARY KEY("id_user","id_level"),
	FOREIGN KEY (id_user) REFERENCES users(id)
	    ON DELETE CASCADE 
	    ON UPDATE CASCADE,
	FOREIGN KEY (id_level) REFERENCES levels(id)
	    ON DELETE CASCADE
	    ON UPDATE CASCADE
);';
