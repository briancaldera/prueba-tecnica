FROM php:8.4-fpm-alpine3.21

WORKDIR /var/www/html

RUN apk update && apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    # For any needed tools
    bash \
    git \
    # Install PHP extensions
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip

    
COPY --from=composer/composer:2-bin /composer /usr/bin/composer

RUN addgroup -S appgroup && adduser -S appuser -G appgroup -u 1000
USER appuser
    
COPY . /var/www/html/

RUN composer install

RUN scripts/migrate.sh

EXPOSE 9000

CMD ["php-fpm"]
