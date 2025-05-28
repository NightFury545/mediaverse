#!/bin/sh

set -e

# Composer install (тільки якщо відсутній vendor)
if [ ! -d "vendor" ]; then
  echo "📦 Running composer install..."
  composer install --no-interaction --optimize-autoloader
fi

# npm install + build (тільки якщо є package.json і відсутній node_modules)
if [ -f "package.json" ]; then
  if [ ! -d "node_modules" ]; then
    echo "🔧 Installing npm dependencies..."
    npm install
  fi

  echo "🔨 Building frontend (Vite)..."
  npm run build || echo "⚠️ Vite build failed, continuing..."
fi

# Laravel key:generate (тільки якщо ключ відсутній)
if [ ! -f ".env" ]; then
  echo "⚠️ .env file is missing. You should add it!"
else
  echo "🔑 Generating app key..."
  php artisan key:generate --force || true
fi

# Laravel migrate (тільки якщо .env існує)
if [ -f ".env" ]; then
  echo "🧬 Running database migrations..."
  php artisan migrate --force || echo "⚠️ Migration failed, continuing..."
fi

# Запуск основної команди (php artisan serve ...)
exec "$@"
