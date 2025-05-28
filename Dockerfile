FROM php:8.2-cli

# Встановити залежності ОС
RUN apt-get update && apt-get install -y \
    unzip git curl zip libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Встановити Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www

# Копіювати Laravel проєкт
COPY . .

# Встановити бекенд-залежності
RUN composer install --no-interaction --optimize-autoloader

# Встановити frontend-залежності (React через Vite)
RUN npm install && npm run build

# php.ini з великими лімітами
RUN echo "upload_max_filesize=100M\npost_max_size=150M\nmemory_limit=512M" > /usr/local/etc/php/php.ini

# Відкрити порт для Render
EXPOSE 8080

# Запуск Laravel сервера
CMD php artisan serve --host=0.0.0.0 --port=8080
