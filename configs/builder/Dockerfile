FROM php:7.3-alpine
RUN echo "Install php extensions" \
    && apk add --no-cache zlib-dev g++ make autoconf gnupg libzip-dev libxml2-dev git $PHPIZE_DEPS postgresql-dev imagemagick-dev imagemagick python2 nodejs nodejs-npm \
    && (yes '' | pecl install -o -f redis) \
    && docker-php-ext-install pdo_pgsql xml mbstring json zip iconv ctype \
    && pecl install -o -f redis \
    && pecl install -o -f imagick \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable imagick \
    && echo "Install composer and npm..." \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && npm install -g npm@latest \
    && npm i -g webpack-cli webpack \
    && npm i -g laravel-echo-server \
    && npm i -g @vue/cli
CMD ["tail", "-f", "/dev/null"]



