FROM php:8.2-fpm-alpine

RUN apk update
RUN apk upgrade
RUN apk add bash
RUN apk add curl

# pdo_mysql
RUN docker-php-ext-install pdo_mysql 

# xdebug
RUN apk add --no-cache linux-headers \
  && apk add --no-cache $PHPIZE_DEPS \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug 

# composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN alias composer='php /usr/bin/composer'

COPY ./php.ini /usr/local/etc/php/
