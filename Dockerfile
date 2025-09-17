FROM composer:latest AS vendor

COPY composer.json composer.lock ./

RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader --ignore-platform-reqs

FROM serversideup/php:8.4-cli-alpine as app

WORKDIR /var/www/html

COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor
COPY --chown=www-data:www-data . .

RUN composer dump-autoload --optimize

ENTRYPOINT ["php", "artisan", "mcp:start", "doc"]
