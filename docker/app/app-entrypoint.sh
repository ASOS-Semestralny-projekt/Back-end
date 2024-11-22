#!/bin/bash

# Exit on error
set -e

# Wait for mysql to startup before doing migrations
until nc -z asos-mysql 3306; do
  echo 'Waiting for MySQL...';
  sleep 2;
done;

# Run Laravel database migrations (optional, comment out if not needed)
echo "Running Laravel migrations..."
php artisan migrate:refresh --force
php artisan db:seed
# Clear and cache configurations
echo "Caching Laravel configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM
echo "Starting PHP-FPM..."
php-fpm

# Keep container running
exec "$@"
