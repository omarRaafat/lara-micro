#!/bin/bash
php-fpm &
php artisan key:generate
php artisan migrate --seed
php artisan optimize:clear
nginx -g 'daemon off;'