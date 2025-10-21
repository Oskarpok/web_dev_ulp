#!/bin/sh

wait-for-it.sh mysql:3306 --timeout=60 --strict -- 

chown -R www-data:www-data /var/www/html/${PROJECT}/storage /var/www/html/${PROJECT}/bootstrap/cache
chmod -R 775 /var/www/html/${PROJECT}/storage /var/www/html/${PROJECT}/bootstrap/cache

cd /var/www/html/${PROJECT}

if [ ! -d "vendor" ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

php artisan migrate --force --no-interaction

# Seeders
if [ "$RUN_SEEDERS" = "true" ]; then
  php artisan db:seed --class="Ulp\\Core\\Database\\Seeders\\DatabaseSeeder" || true
fi

exec php-fpm