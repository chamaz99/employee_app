#!/bin/bash
# Fix storage and cache permissions dynamically
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
sed -i -s "s/80/$PORT/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf
php artisan config:cache
php artisan route:cache
php artisan migrate --force
apache2-foreground