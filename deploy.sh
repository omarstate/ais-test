#!/bin/bash

# Generate application key
php artisan key:generate

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan optimize

# Set permissions
chmod -R 777 storage bootstrap/cache

# Start the application
php artisan serve --host 0.0.0.0 --port $PORT 