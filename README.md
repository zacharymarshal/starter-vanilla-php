# 🍦-PHP

Starting point for a vanilla php application.

### Whats included?

- [Composer](https://getcomposer.org/doc/) for all your php
  dependencies.
- [php-cs-fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) for
  formatting your PHP code.
- [phpstan](https://phpstan.org/) to check for all things that
  can make for some bad code.

### Getting started

1. Create environment file `cp .env.default .env`
2. Run `docker compose up`
3. Install Composer dependencies `docker compose exec php-fpm composer install`
4. Go to http://localhost:50080/ to see things a working

### Useful Commands

Use `psql` to run some queries.

```
docker compose exec postgres psql \
  postgres://postgres:postgres@postgres:5432/postgres
```

Run `php-cs-fixer` to format your code.

```
docker compose exec php-fpm php-cs-fixer fix
```

Run `composer` to install dependencies and whatnot.

```
docker compose exec php-fpm composer install
```

Run `phpstan` to check your code for issues.

```
docker compose exec php-fpm phpstan analyse
```
