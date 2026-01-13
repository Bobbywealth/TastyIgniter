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

# 1. Publish TastyIgniter core configs if they don't exist
echo "Publishing TastyIgniter configurations..."
php artisan vendor:publish --tag=igniter-config --force || true

# 2. Run TastyIgniter Update (This handles TI-specific migrations and extensions)
echo "Running TastyIgniter:up..."
php artisan igniter:up --no-interaction

# 3. Standard Production Optimizations
echo "Running production optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
