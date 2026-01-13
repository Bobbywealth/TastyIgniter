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

# 1. FORCE WIPE (Temporary to fix the PostgreSQL error)
echo "Wiping database to fix Not Null violation..."
php artisan db:wipe --force || true

# 2. Publish TastyIgniter core configs
echo "Publishing TastyIgniter configurations..."
php artisan vendor:publish --tag=igniter-config --force || true

# 3. Run TastyIgniter Update (Fresh install)
echo "Running TastyIgniter:up --force..."
php artisan igniter:up --force --no-interaction

# 4. Production Optimizations
echo "Running production optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
