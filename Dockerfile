# Use official PHP image with Apache
FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Enable Apache mod_rewrite (needed for Symfony routes)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy everything into the container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Set DocumentRoot to Symfony public directory
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf


# Run migrations automatically (TEMPORARY)
RUN php bin/console doctrine:migrations:migrate --no-interaction || true
