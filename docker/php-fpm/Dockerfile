FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev \
    openssl

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /symfony

# CMD sleep 15; php bin/console doctrine:migrations:migrate --no-interaction;
