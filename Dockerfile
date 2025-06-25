# ---- Build stage -------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# ---- Runtime stage ----------------------------------------------
FROM php:8.3-apache

# Enable Apache modules required by Laravel
RUN a2enmod rewrite

# Install PHP extensions Laravel commonly needs
RUN apt-get update \
    && apt-get install -y libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Copy application code and vendor libraries
COPY --from=vendor /app /var/www/html
COPY . /var/www/html

# Set document root to public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Ensure permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port that Render maps to $PORT
EXPOSE 8080

CMD ["apache2-foreground"]
