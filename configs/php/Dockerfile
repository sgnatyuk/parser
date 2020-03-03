FROM php:7.3-fpm-alpine

RUN apk add --no-cache gnupg postgresql-dev libzip-dev libxml2-dev git imagemagick-dev imagemagick $PHPIZE_DEPS \
    && (yes '' | pecl install -o -f redis) \
    && docker-php-ext-install pdo_pgsql xml mbstring json zip iconv ctype \
    && rm -rf /usr/local/etc/php-fpm.d/* \
    && pecl install -o -f redis \
    && pecl install -o -f imagick \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable imagick

COPY ./init.d/fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./init.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
