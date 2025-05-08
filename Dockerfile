# Usa PHP 8.2 con Apache
FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia archivos de Laravel al contenedor
COPY . /var/www/html

# Configura permisos y Apache
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Puerto 80 para Apache
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
