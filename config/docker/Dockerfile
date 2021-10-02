# @author Nasir Aliyev <alievnesir@gmail.com>

# Master image
FROM php:8.0-fpm

RUN apt-get update

RUN apt-get install -y \
    zlib1g-dev \
    libzip-dev

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install mongodb

RUN echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongo.ini

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www/html/

COPY --chown=www:www . /var/www/html/

USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
