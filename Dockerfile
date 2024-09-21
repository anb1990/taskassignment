FROM php:8.2-fpm
# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/taskassignment

COPY . /var/www/taskassignment

# Install dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/taskassignment
RUN chmod -R 755 /var/www/taskassignment

EXPOSE 9000
CMD ["php-fpm"]
