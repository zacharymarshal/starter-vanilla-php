FROM php:8.5-fpm-bookworm

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    libpq-dev \
    postgresql-client \
    libzip-dev \
    unzip \
    git \
  && docker-php-ext-install \
    pgsql \
    pdo_pgsql \
    zip \
  && pecl install xdebug-3.5.1 \
  && docker-php-ext-enable xdebug \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN curl -LsS https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/releases/download/v3.95.2/php-cs-fixer.phar > /usr/local/bin/php-cs-fixer \
  && chmod 0755 /usr/local/bin/php-cs-fixer

RUN curl -LsS https://github.com/phpstan/phpstan/releases/download/2.1.55/phpstan.phar > /usr/local/bin/phpstan \
  && chmod 0755 /usr/local/bin/phpstan

WORKDIR /app
