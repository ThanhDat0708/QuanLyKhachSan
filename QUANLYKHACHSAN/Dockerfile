# Sử dụng PHP image
FROM php:8.2-apache

# Cài đặt các dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy Apache config
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/sites-available/000-default.conf

# Set Apache DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]
