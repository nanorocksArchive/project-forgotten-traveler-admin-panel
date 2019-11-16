# space-shooter-api
API for android game build with PHP

#### users 
 - id_user
 - username
 - password
 - email
 - total_time on start 0

#### scores
 - id_user
 - id_level 
 - level
 - coints
 - stars
 - time

#### levels
 - id_level
 - name
 - total_coints
 - total_stars

##### for users use token (jwt):
	register new users
	check_login and return id if true
	count_total users (no jwt)
	edit user info
	forgot password 

##### for levels full stack:
	insert level
	edit level
	select for all levels

##### for scores (jwt):
	- insert
	- select all info for scores for user with id and id level (jwt)

##### for user-score:
	- agregate function for total_score_user, total_coints_user, total_stars_user (jwt)
