#!/bin/bash
set -e

PORT="${PORT:-8080}"

# Reemplazar puerto dinámico de Render
sed -i "s/listen 8080;/listen ${PORT};/g" /etc/nginx/sites-available/default

mkdir -p /var/run/php

# ✅ Migraciones automáticas en cada deploy
php /var/www/artisan migrate --force
php /var/www/artisan config:cache
php /var/www/artisan route:cache
php /var/www/artisan view:cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
