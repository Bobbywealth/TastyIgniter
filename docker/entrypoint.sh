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

# Production Optimizations
echo "Running production optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations automatically (safe for production with --force)
echo "Running migrations..."
php artisan migrate --force

echo "Starting Apache..."
exec apache2-foreground
