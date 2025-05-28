#!/bin/sh

# Якщо папка vendor відсутня, виконуємо composer install
if [ ! -d "vendor" ]; then
  echo "Vendor folder not found. Running composer install..."
  composer install --no-interaction --optimize-autoloader
fi

# Запускаємо npm install і збірку фронтенду (опційно, якщо React/Vite в проєкті)
if [ ! -d "node_modules" ]; then
  echo "Installing npm packages and building frontend..."
  npm install
  npm run build
fi

# Запускаємо основну команду (наприклад, php artisan serve)
exec "$@"
