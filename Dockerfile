FROM php:8.2-fpm

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev zip unzip nginx supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/laTrocha

# Copiar código e instalar dependencias
COPY laTrocha/ .

# Instalar dependencias
RUN composer install --optimize-autoloader --no-dev

# Permisos de Laravel
RUN chown -R www-data:www-data /var/www/laTrocha/storage /var/www/laTrocha/bootstrap/cache \
    && chmod -R 775 /var/www/laTrocha/storage /var/www/laTrocha/bootstrap/cache


# Configs
RUN mkdir -p /var/log/supervisor
COPY docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 8080
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
