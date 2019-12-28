#!/bin/bash

docker run --rm -d -v $(pwd)/app:/var/www/localhost/ --name apache -p 80:80 nanorocks/alpine-devbox