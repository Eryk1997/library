FROM php:8.4-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libicu-dev git libzip-dev zip libpng-dev\
    && apt-get install -y librabbitmq-dev \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && apt-get install -y npm \
    && docker-php-ext-install intl opcache pdo pdo_mysql zip gd pcntl

COPY --from=composer/composer:2.5.4 /usr/bin/composer /usr/bin/composer

ENV PHP_IDE_CONFIG="serverName=dev"