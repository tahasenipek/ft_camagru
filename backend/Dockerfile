FROM php:8.1-fpm-alpine

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --no-interaction

EXPOSE 9000

CMD ["php-fpm"]