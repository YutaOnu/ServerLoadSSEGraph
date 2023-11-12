FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y git unzip libzip-dev && \
    docker-php-ext-install zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY composer.json .
RUN composer install
