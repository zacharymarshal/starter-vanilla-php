FROM php:8.2.10-fpm

RUN apt-get update \
  && apt-get install -y \
    libpq-dev \
    postgresql-client \
    libzip-dev \
  && docker-php-ext-install \
    opcache\
    pgsql \
    zip \
  && pecl install xdebug-3.2.2 \
  && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer >composer-setup.php \
  && php composer-setup.php --quiet \
    --install-dir=/usr/local/bin --filename=composer \
  && rm composer-setup.php

RUN curl -LsS https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/download/v3.27.0/php-cs-fixer.phar > /usr/local/bin/php-cs-fixer \
  && chmod 0755 /usr/local/bin/php-cs-fixer

RUN curl -LsS https://github.com/phpstan/phpstan/releases/download/1.10.35/phpstan.phar > /usr/local/bin/phpstan \
  && chmod 0755 /usr/local/bin/phpstan

WORKDIR /app