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
 - coints
 - stars
 - time

#### levels for web
 - id_level
 - name
 - total_coints
 - total_stars

##### for users use token (jwt):
	register new users
	check_login and return id if true
	edit user info
	forgot password 
	select for all levels

##### for levels full stack:
	insert level
	edit level
	select for all levels
	count_total users

##### for scores (jwt):
	- insert for mobile (jwt)
	- select all info for scores for user with id and id level (jwt)

##### for user-score:
	- agregate function for total_score_user, total_coints_user, total_stars_user (jwt)
	this is for mobile


# alpine-php-docker-devbox
Devbox with alpine-apache2-php7 only 40MB


### To build use:
###### `docker build -t nanorocks/alpine-devbox -f docker/server/Dockerfile .`

### To run:
###### `docker run -d -v $(pwd)/app:/var/www/localhost/ --name apache -p 8080:80 nanorocks/alpine-devbox`
