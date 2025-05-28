FROM php:8.2-cli

# Встановити системні залежності
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

# php.ini з великими лімітами
RUN echo "upload_max_filesize=100M\npost_max_size=150M\nmemory_limit=512M" > /usr/local/etc/php/php.ini

# Копіюємо entrypoint-скрипт
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Відкрити порт
EXPOSE 8080

# Запуск через entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
