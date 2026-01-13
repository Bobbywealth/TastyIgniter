# Stage 1: Build assets
FROM node:18-alpine AS assets-builder
WORKDIR /app
COPY package*.json webpack.mix.js ./
COPY resources ./resources
RUN npm install && npm run prod

# Stage 2: Production PHP environment
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql zip mbstring xml intl bcmath opcache \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Copy built assets from Stage 1
COPY --from=assets-builder /app/public/css ./public/css
COPY --from=assets-builder /app/public/js ./public/js
COPY --from=assets-builder /app/mix-manifest.json ./public/mix-manifest.json

# Set Apache DocumentRoot to public and listen on Render's PORT
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Apache to use the PORT environment variable provided by Render
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Set proper permissions for Laravel and TastyIgniter
RUN mkdir -p storage/framework/cache/data \
    storage/framework/app/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/igniter \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configure PHP for production (opcache)
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Set default port if not provided (Render provides this automatically)
ENV PORT=80
EXPOSE ${PORT}

CMD ["apache2-foreground"]
