# Use PHP 8.2 as base image
FROM php:8.2-fpm

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Install Nginx
RUN apt-get update && apt-get install -y nginx \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/sites-available/default

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy your application files
COPY . /var/www/html

# Change directory
WORKDIR /var/www/html


    

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

RUN php artisan migrate --force
# Start both PHP-FPM and Nginx
CMD service nginx start && php-fpm