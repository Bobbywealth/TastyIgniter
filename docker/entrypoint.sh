#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-80}"

# Configure Apache to listen on Render's dynamic port.
# ports.conf normally contains: "Listen 80"
if grep -qE '^Listen ' /etc/apache2/ports.conf; then
  sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
else
  echo "Listen ${PORT}" >> /etc/apache2/ports.conf
fi

# Update default vhost to match the port (typically "<VirtualHost *:80>")
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

exec apache2-foreground

