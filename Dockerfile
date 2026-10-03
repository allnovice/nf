FROM php:8.4-fpm

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    libpng-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    bcmath \
    xml \
    zip \
    gd \
    && rm -rf /var/lib/apt/lists/*
