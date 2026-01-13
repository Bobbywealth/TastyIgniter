#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-80}"

# Configure Apache
if grep -qE '^Listen ' /etc/apache2/ports.conf; then
  sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
else
  echo "Listen ${PORT}" >> /etc/apache2/ports.conf
fi
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# --- THE "NUKE & REBUILD" FIX ---
echo "Nuking broken database to start fresh..."
php artisan db:wipe --force || true

echo "Running TastyIgniter:up..."
php artisan igniter:up --force --no-interaction

# Ensure core configurations are published
php artisan vendor:publish --tag=igniter-config --force || true

echo "Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
