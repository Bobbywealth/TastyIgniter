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

# --- THE "LIVE NOW" FIX ---
echo "Cleaning up database constraints..."
# This fixes the 'Dependent objects still exist' error for PostgreSQL
php artisan tinker --execute="try { Schema::hasTable('admin_users') && DB::statement('ALTER TABLE admin_users DROP CONSTRAINT IF EXISTS admin_users_staff_id_unique CASCADE'); } catch (\Exception \$e) {}"

echo "Running TastyIgniter:up..."
php artisan igniter:up --force --no-interaction

# Ensure we have the basic setup
echo "Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
