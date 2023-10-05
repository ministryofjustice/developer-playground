FROM php:8.0-fpm-alpine AS base

RUN apk add --update bash zlib-dev libpng-dev libzip-dev $PHPIZE_DEPS
RUN docker-php-ext-install exif
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql

# INSTALL APCU (used by jobilla/cloud-native-laravel)
#ARG APCU_VERSION=5.1.20
#RUN pecl install apcu-${APCU_VERSION} && docker-php-ext-enable apcu
#RUN echo "apc.enable_cli=1" >> /usr/local/etc/php/php.ini
#RUN echo "apc.enable=1" >> /usr/local/etc/php/php.ini

###


## target: dev
FROM base AS dev

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY /composer.json composer.json
COPY /app app
COPY /bootstrap bootstrap
COPY /config config
COPY /artisan artisan

RUN apk add --update nano nodejs npm

###


## target: production
FROM base AS build-composer

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY ./composer.json /var/www/html/composer.json
RUN composer install --no-dev --no-scripts --no-autoloader

COPY . /var/www/html
RUN composer install --no-dev
RUN composer dump-autoload -o

###


FROM base AS build-fpm

WORKDIR /var/www/html
COPY --from=build-composer /var/www/html /var/www/html

###


FROM build-fpm AS test
RUN make test

###


FROM node:16 AS assets-build

WORKDIR /code
COPY . /code/
RUN npm ci
RUN npm run production

###


FROM nginx:1.19-alpine AS nginx

COPY vhost-prod.conf /etc/nginx/conf.d/default.conf
COPY --from=assets-build /code/public /var/www/html/
