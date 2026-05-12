FROM php:8.2-fpm

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev \
    libzip-dev zip unzip \
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
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Exponer el puerto dinámico
EXPOSE 8080

# Arrancar Laravel directamente en el puerto que Railway asigna
CMD php artisan serve --host=0.0.0.0 --port=$PORT
