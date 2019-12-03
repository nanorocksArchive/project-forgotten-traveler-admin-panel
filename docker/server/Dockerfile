FROM alpine:latest

# Who am I ?
MAINTAINER Andrej Nankov

# Install bash
RUN apk add --update bash && rm -rf /var/cache/apk/*

# For service control
RUN apk add openrc

# Update and upgrade
RUN apk update && apk upgrade

# Install apache2 and php7 module
RUN apk add apache2 php7-apache2

# Install php
RUN apk add php7 php7-fpm php7-opcache

# Php modules
RUN apk add php7-gd php7-mysqli php7-zlib php7-curl php7-session php7-json php7-pdo php7-pdo_mysql php7-sqlite3 php7-iconv

# Add new apache config -- Fix this
COPY docker/server/httpd-apache2.conf /etc/apache2/httpd.conf

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /etc/apache2/httpd.conf && \
    sed -i 's#AllowOverride [Nn]one#AllowOverride All#' /etc/apache2/httpd.conf

WORKDIR /var/www

RUN rm -rf /var/cache/apk/*
ENTRYPOINT ["httpd"] 
CMD ["-D", "FOREGROUND"]

# to build use:
# docker build -t nanorocks/alpine-devbox -f docker/server/Dockerfile .

# to run:
# docker run --rm -d -v $(pwd)/app:/var/www/localhost/ --name apache -p 80:80 nanorocks/alpine-devbox