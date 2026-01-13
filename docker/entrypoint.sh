#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-80}"

# Configure Apache to listen on Render's dynamic port.
if grep -qE '^Listen ' /etc/apache2/ports.conf; then
  sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
else
  echo "Listen ${PORT}" >> /etc/apache2/ports.conf
fi

# Update default vhost to match the port
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# 1. Publish TastyIgniter core configs
echo "Publishing TastyIgniter configurations..."
php artisan vendor:publish --tag=igniter-config --force || true

# 2. Run TastyIgniter Update with --force to bypass production warning
echo "Running TastyIgniter:up --force..."
php artisan igniter:up --force --no-interaction

# 3. Clear any old caches that might be blocking routes
echo "Clearing caches..."
php artisan config:clear
php artisan route:clear

# 4. Production Optimizations
echo "Running production optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
