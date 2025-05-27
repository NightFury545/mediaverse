FROM php:8.2-fpm

# Встановлюємо залежності для Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Встановлюємо Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копіюємо Laravel додаток
WORKDIR /var/www/html
COPY . .

# Встановлюємо залежності через Composer
RUN composer install --no-dev --optimize-autoloader

# Права для storage і bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Відкриваємо порт
EXPOSE 9000

# Запускаємо php-fpm
CMD ["php-fpm"]
