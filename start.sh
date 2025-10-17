#!/usr/bin/env bash
# Render.com Start Script for Laravel

echo "Starting Laravel Asset Management Application..."

# Start PHP-FPM and Nginx
php-fpm -D && nginx -g "daemon off;"
