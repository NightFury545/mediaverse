FROM php:8.2-cli

# Встановити системні залежності, включно з intl і zip
RUN apt-get update && apt-get install -y \
    unzip git curl zip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev g++ nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Встановити Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www

# Копіювати Laravel-проєкт
COPY . .

# Встановити бекенд-залежності
RUN composer install --no-interaction --optimize-autoloader

# Встановити frontend-залежності (якщо React інтегрований через Vite)
RUN npm install && npm run build

# php.ini з великими лімітами
RUN echo "upload_max_filesize=100M\npost_max_size=100M\nmemory_limit=512M" > /usr/local/etc/php/php.ini

# Відкрити порт
EXPOSE 8080

# Запуск Laravel сервера
CMD php artisan serve --host=0.0.0.0 --port=8080
