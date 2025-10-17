#!/usr/bin/env bash
# Render.com Build Script for Laravel

echo "Building Laravel Asset Management Application..."

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Install npm dependencies and build assets
echo "Installing npm dependencies..."
npm install

echo "Building assets..."
npm run build

# Set proper permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

# Clear and optimize caches
echo "Optimizing application..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run database migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# Seed database if needed (optional - remove if not needed)
# php artisan db:seed --force --no-interaction

# Cache configuration, routes, and views
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Create storage link
echo "Creating storage link..."
php artisan storage:link

echo "Build completed successfully!"
