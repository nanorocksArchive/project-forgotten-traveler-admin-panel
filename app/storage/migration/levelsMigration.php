<?php

// create table levels
return '
CREATE TABLE IF NOT EXISTS "levels" (
	"id" INTEGER PRIMARY KEY AUTOINCREMENT,
	"name" VARCHAR(255) NOT NULL,
	"total_coints" INTEGER DEFAULT 0,
	"total_stars" INTEGER DEFAULT 0
);';
