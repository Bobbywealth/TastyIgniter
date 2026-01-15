#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-80}"

# Configure Apache
if grep -qE '^Listen ' /etc/apache2/ports.conf; then
  sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
else
  echo "Listen ${PORT}" >> /etc/apache2/ports.conf
fi
# Update both 000-default.conf and any other vhost to listen on $PORT
find /etc/apache2/sites-available -name "*.conf" -exec sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" {} +

# Wait for database connection (optional but recommended for Render)
echo "Checking database connection..."
for i in {1..30}; do
  if php artisan tinker --execute="try { DB::connection()->getPdo(); exit(0); } catch (\Exception \$e) { exit(1); }" > /dev/null 2>&1; then
    echo "Database is ready!"
    break
  fi
  echo "Database not ready yet (attempt $i/30)..."
  sleep 2
done

# Publish TastyIgniter core configs (safe to re-run)
echo "Publishing TastyIgniter configuration..."
php artisan vendor:publish --tag=igniter-config --force || true

# Ensure default theme exists and assets are published (fixes missing CSS/JS)
if [ ! -d /var/www/html/themes/igniter-orange ]; then
  echo "Installing default theme (igniter-orange)..."
  php artisan igniter:theme-install igniter-orange --no-interaction || echo "Theme install failed, continuing..."
fi
echo "Publishing theme assets..."
php artisan igniter:theme-publish --no-interaction || echo "Theme publish failed, continuing..."
php artisan igniter:theme-vendor-publish --no-interaction || echo "Theme vendor publish failed, continuing..."

# Patch geocoder endpoints to use local proxy instead of Nominatim directly
echo "Patching geocoder endpoints..."
for search_path in /var/www/html/themes /var/www/html/public/themes /var/www/html/storage /var/www/html/public; do
  if [ -d "$search_path" ]; then
    while IFS= read -r -d '' file; do
      sed -i \
        -e 's#https://nominatim.openstreetmap.org#/geocode#g' \
        -e 's#//nominatim.openstreetmap.org#/geocode#g' \
        "$file"
    done < <(grep -rlZ "nominatim.openstreetmap.org" "$search_path" 2>/dev/null || true)
  fi
done

# Ensure public storage symlink exists for media uploads
echo "Ensuring public storage symlink..."
php artisan storage:link || echo "Storage link failed, continuing..."

# Pre-flight DB cleanup for PostgreSQL:
# Some upstream TI migrations attempt to DROP INDEX where Postgres requires dropping the constraint instead.
echo "Pre-flighting DB (PostgreSQL constraint/index cleanup)..."
php artisan tinker --execute="try { DB::statement(\"ALTER TABLE admin_users DROP CONSTRAINT IF EXISTS admin_users_staff_id_unique\"); } catch (\\Throwable \$e) {}" >/dev/null 2>&1 || true
php artisan tinker --execute="try { DB::statement(\"DROP INDEX IF EXISTS admin_users_staff_id_unique\"); } catch (\\Throwable \$e) {}" >/dev/null 2>&1 || true
php artisan tinker --execute="try { DB::statement(\"DROP INDEX IF EXISTS coupon_id_index\"); } catch (\\Throwable \$e) {}" >/dev/null 2>&1 || true
php artisan tinker --execute="try { DB::statement(\"ALTER TABLE reservations ALTER COLUMN status_id TYPE bigint USING status_id::bigint\"); } catch (\\Throwable \$e) {}" >/dev/null 2>&1 || true
php artisan tinker --execute="try { DB::statement(\"ALTER TABLE reservations ALTER COLUMN status_id DROP NOT NULL\"); } catch (\\Throwable \$e) {}" >/dev/null 2>&1 || true

echo "Running TastyIgniter:up (forced, non-interactive)..."
php artisan igniter:up --force --no-interaction || { echo "TastyIgniter:up failed!"; exit 1; }

echo "Optimizing Laravel caches..."
php artisan config:cache || echo "Config cache failed, continuing..."

echo "Listing routes for debug..."
mkdir -p /var/www/html/storage/logs
php artisan route:list > /var/www/html/storage/logs/routes_before_cache.txt || echo "Route list failed, continuing..."

echo "Caching routes..."
php artisan route:cache || echo "Route cache failed, continuing..."

echo "Caching views..."
php artisan view:cache || echo "View cache failed, continuing..."

echo "Starting Apache..."
exec apache2-foreground
