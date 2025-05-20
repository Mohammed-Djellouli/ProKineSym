# Stage 1: Build image with Apache + PHP
FROM php:8.2-apache

# Install required system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Enable Apache mod_rewrite (Symfony uses pretty URLs)
RUN a2enmod rewrite

# Set working directory inside the container
WORKDIR /var/www/html

# Copy project files into the container
COPY . .

# Install Composer from official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Skip Symfony's auto-scripts (like cache:clear) during composer install
ENV SYMFONY_SKIP_AUTO_RUN=1

# Allow Composer to run as root (in Docker it's okay)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Set Apache to serve Symfony from the public/ directory
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Expose HTTP port (Render auto-detects this, but it's a good practice)
EXPOSE 80

# Optional: Run database migrations at build time (remove after first deploy)
# RUN php bin/console doctrine:migrations:migrate --no-interaction || true
