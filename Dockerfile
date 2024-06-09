FROM  php:8.2-fpm

WORKDIR /laraMicro

ADD . .

#laravel required env file for deploying
COPY .env.example .env

RUN apt-get update && apt-get install -y mariadb-server \
nano \
build-essential \
libpng-dev \
libjpeg62-turbo-dev \
libfreetype6-dev \
locales \
zip \
jpegoptim optipng pngquant gifsicle \
vim \
libzip-dev \
unzip \
git \
libonig-dev \
curl \
nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

COPY composer.json composer.lock /laraMicro/

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# copy nginx configuration to container
COPY ./app.conf /etc/nginx/sites-enabled/default

# RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php/8.2/fpm/php.ini

RUN apt-get clean



# shell script to start nginx web server
COPY /scripts/cmd.sh /usr/local/bin/cmd.sh

# install laravel dependencies and packages via composer
RUN composer install --ignore-platform-reqs --no-interaction --no-scripts --no-progress

# copy all installed configuration inside Container image

# fix 301 forbidden permission to laravel storage and caches for read and write
RUN  chgrp -R www-data /laraMicro/storage /laraMicro/bootstrap/cache &&  chmod -R ug+rwx /laraMicro/storage /laraMicro/bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache && chmod 777 -R /laraMicro/storage /laraMicro/bootstrap/cache

# make shell script (cmd.sh) excutable
RUN chmod 777 /usr/local/bin/cmd.sh && chmod +x /usr/local/bin/cmd.sh
# generates new key for laravel env file

EXPOSE 8080

# Run Laravel commands script
CMD ["/usr/local/bin/cmd.sh"]


