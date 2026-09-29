FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY docker/supervisord.conf /etc/supervisor/conf.d/app.conf

EXPOSE 10000

CMD php artisan config:cache && supervisord -c /etc/supervisor/conf.d/app.conf