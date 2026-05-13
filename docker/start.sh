#!/bin/bash
set -e

PORT="${PORT:-8080}"

sed -i "s/listen 8080;/listen ${PORT};/g" /etc/nginx/sites-available/default

mkdir -p /var/run/php /var/log/nginx /var/log/supervisor

chmod -R 777 /var/www/laTrocha/storage
chmod -R 777 /var/www/laTrocha/bootstrap/cache

php /var/www/laTrocha/artisan migrate:fresh --force
php /var/www/laTrocha/artisan config:cache
php /var/www/laTrocha/artisan route:cache
php /var/www/laTrocha/artisan view:cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf