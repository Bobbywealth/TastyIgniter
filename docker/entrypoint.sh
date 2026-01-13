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

# Publish TastyIgniter core configs (safe to re-run)
echo "Publishing TastyIgniter configuration..."
php artisan vendor:publish --tag=igniter-config --force || true

# Pre-flight DB cleanup for PostgreSQL:
# Some upstream TI migrations attempt to DROP INDEX where Postgres requires dropping the constraint instead.
echo "Pre-flighting DB (PostgreSQL constraint/index cleanup)..."
php artisan tinker --execute="try { DB::statement(\"ALTER TABLE admin_users DROP CONSTRAINT IF EXISTS admin_users_staff_id_unique\"); } catch (\\Throwable \\$e) {}" >/dev/null 2>&1 || true
php artisan tinker --execute="try { DB::statement(\"DROP INDEX IF EXISTS admin_users_staff_id_unique\"); } catch (\\Throwable \\$e) {}" >/dev/null 2>&1 || true
php artisan tinker --execute="try { DB::statement(\"DROP INDEX IF EXISTS coupon_id_index\"); } catch (\\Throwable \\$e) {}" >/dev/null 2>&1 || true

echo "Running TastyIgniter:up (forced, non-interactive)..."
php artisan igniter:up --force --no-interaction

echo "Optimizing Laravel caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting Apache..."
exec apache2-foreground
