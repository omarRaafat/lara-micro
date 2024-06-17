#!/bin/bash
php-fpm &
php artisan key:generate
php artisan cache:clear
php artisan route:clear
php artisan config:clear 
php artisan view:clear
php artisan migrate --seed
php artisan test
nginx -g 'daemon off;'

