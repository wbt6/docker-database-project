# Dockerfile
# Dockerfile for PHP + Apache with PDO_PGSQL enabled
FROM php:8.1-apache

# Install dependencies for PostgreSQL PDO and other helpful packages
RUN apt-get update && apt-get install -y libpq-dev unzip     && docker-php-ext-install pdo pdo_pgsql     && rm -rf /var/lib/apt/lists/*

# Copy application
COPY . /var/www/html/

# Ensure permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache rewrite (if needed)
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]