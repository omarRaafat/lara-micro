#!/bin/bash
php-fpm &
php artisan key:generate
php artisan optimize:clear
php artisan migrate --seed
nginx -g 'daemon off;'