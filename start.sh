#!/bin/bash
nginx -g 'daemon off;'

# Any setup commands can go here
php artisan migrate --force   # Example: Run database migrations
php-fpm                       # Start the PHP FastCGI Process Manager
composer install --no-dev --optimize-autoloader
php artisan key:generate
npm install
npm run prod