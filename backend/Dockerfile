FROM php:8.1-fpm-alpine

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP extensions
RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --no-interaction

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]