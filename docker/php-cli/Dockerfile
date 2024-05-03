FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli zip

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

# CMD ["php", "/symfony/bin/console doctrine:migrations:migrate --no-interaction"]

WORKDIR /symfony

# Create hello world script
# CMD php bin/console doctrine:migrations:migrate --no-interaction
