#!/bin/bash
set -e

# Render inyecta $PORT dinámicamente — nginx debe escuchar en ese puerto
PORT="${PORT:-8080}"

# Reemplazar el puerto en nginx config
sed -i "s/listen 8080;/listen ${PORT};/g" /etc/nginx/sites-available/default

# Crear socket directory para PHP-FPM
mkdir -p /var/run/php

# Cachear configuración de Laravel
php /var/www/artisan config:cache
php /var/www/artisan route:cache
php /var/www/artisan view:cache

# Arrancar todo con supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf