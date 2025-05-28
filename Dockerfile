# 1. Базовий образ
FROM php:8.2-cli

# 2. Встановити системні пакети
RUN apt-get update && apt-get install -y \
    unzip git curl zip libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 3. Встановити Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Створити робочу директорію
WORKDIR /var/www

# 5. Копіювати Laravel-код
COPY backend/ /var/www/

# 6. Встановити Laravel-залежності
RUN composer install --no-interaction --optimize-autoloader

# 7. Копіювати React-код і зібрати його
COPY frontend/ /var/www/frontend
WORKDIR /var/www/frontend
RUN npm install && npm run build

# 8. Копіювати білд в Laravel `public/`
RUN cp -r build/* /var/www/public/

# 9. Повернутися до кореня Laravel
WORKDIR /var/www

# 10. php.ini з великими лімітами
RUN echo "upload_max_filesize=100M\npost_max_size=100M\nmemory_limit=512M" > /usr/local/etc/php/php.ini

# 11. Відкрити порт для Render
EXPOSE 8080

# 12. Команда запуску Laravel через php artisan serve
CMD php artisan serve --host=0.0.0.0 --port=8080
