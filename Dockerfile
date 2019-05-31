FROM wordpress:5-apache

RUN docker-php-ext-install pdo_mysql exif bcmath