FROM php:8.2-fpm



ENV COMPOSER_PROCESS_TIMEOUT=600
# ENV COMPOSER_DISABLE_NETWORK=1

RUN apt-get update && \
    apt-get install -y \
    libzip-dev zlib1g-dev libicu-dev g++ libonig-dev libpng-dev libxml2-dev libjpeg62-turbo-dev libfreetype6-dev libsodium-dev libbz2-dev curl gnupg git && \
    curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    docker-php-ext-install zip intl pdo_mysql mbstring gd sodium bz2 bcmath && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html



COPY ./src /var/www/html
COPY ./src/php.ini /usr/local/etc/php
COPY ./src/DigiCertGlobalRootCA.crt /var/www/html

RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN npm install --force
RUN npm run build

# RUN php artisan key:generate

# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache

RUN php artisan cache:clear

RUN php artisan storage:link



RUN php artisan config:clear
# RUN php artisan migrate --force



RUN composer dump-autoload




CMD sh -c "php artisan serve"
