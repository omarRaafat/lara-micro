#!/bin/sh

# Run Composer install
composer install 

# Generate application key
php artisan key:generate

# Clear caches
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear

# Run migrations
php artisan migrate --force

# Seed the database
php artisan db:seed

# Start PHP-FPM
php-fpm &

# start nginx server
nginx -g 'daemon off;'
