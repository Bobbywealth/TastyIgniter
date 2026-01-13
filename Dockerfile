FROM php:8.3-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql zip mbstring xml \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Install composer dependencies with retry
RUN composer install --no-dev --optimize-autoloader --no-interaction || composer install --no-dev --optimize-autoloader --no-interaction

# Create necessary directories
RUN mkdir -p storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

# Copy Apache configuration
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf || true

EXPOSE 80

CMD ["apache2-foreground"]
