FROM  php:8.2-fpm

WORKDIR /var/www

# Install system dependencies

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

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php/8.2/fpm/php.ini

RUN apt-get clean

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

#laravel required env file for deploying
COPY .env.docker .env

# copy nginx configuration to container
COPY ./app.conf /etc/nginx/sites-enabled/default

# Copy the entrypoint script
COPY ./app.sh /usr/local/bin/app.sh

# make shell script (cmd.sh) excutable
RUN  chmod +x /usr/local/bin/app.sh

# fix 301 forbidden permission to laravel storage and caches for read and write
RUN  chgrp -R www-data storage bootstrap/cache &&  chmod -R ug+rwx storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache && chmod 777 -R storage bootstrap/cache

# Change current user to www
USER www-data


EXPOSE 8080

# Run Laravel commands script
ENTRYPOINT ["/usr/local/bin/app.sh"]


