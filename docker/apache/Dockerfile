FROM php:7.4-apache

RUN docker-php-ext-install mysqli

RUN apt-get update && apt-get install -y libzip-dev zip unzip \
    && docker-php-ext-install zip

RUN a2enmod rewrite

EXPOSE 80
