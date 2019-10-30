<?php

// create table users
return '
CREATE TABLE IF NOT EXISTS "users" (
	"id" INTEGER PRIMARY KEY AUTOINCREMENT,
	"username" VARCHAR(255) UNIQUE NOT NULL,
	"password" VARCHAR(255) NOT NULL,
	"email"	VARCHAR(255) UNIQUE NOT NULL,
	"total_time" VARCHAR(255)
);';
