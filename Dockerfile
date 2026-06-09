FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

RUN set -eux; \
    apk add --no-cache \
        libzip-dev \
        zip \
        unzip \
    ; \
    docker-php-ext-install pdo_mysql zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist --no-interaction

COPY . .

RUN php artisan optimize
RUN php artisan view:cache
RUN php artisan route:cache

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
