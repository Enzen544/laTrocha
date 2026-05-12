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

<<<<<<< HEAD
# Copiar código
COPY . .
=======
# Copiar código e instalar dependencias
COPY laTrocha/ .
>>>>>>> fc74fc3cc088c95c71c241e23bcd0fdc3f0ff917

# Instalar dependencias
RUN composer install --optimize-autoloader --no-dev

# Permisos de Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

<<<<<<< HEAD
# Configs
RUN mkdir -p /var/log/supervisor /var/log/nginx

COPY docker/nginx/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Script de inicio que lee $PORT de Render
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
=======
# Script de arranque
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# Exponer puerto (Railway usará $PORT)
EXPOSE 8080

# Arrancar Laravel con el puerto dinámico
CMD ["/start.sh"]
>>>>>>> fc74fc3cc088c95c71c241e23bcd0fdc3f0ff917
