#!/usr/bin/env bash

echo "🔧 Running Composer..."
composer install --no-dev --working-dir=/var/www/html

echo "🔐 Generating app key..."
php artisan key:generate --force

echo "🚀 Caching config & routes..."
php artisan config:cache
php artisan route:cache

echo "🗄️ Running migrations..."
php artisan migrate --force

echo "✅ Starting Nginx + PHP-FPM..."
exec /start.sh
