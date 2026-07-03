#!/bin/bash
# Laravel Storage Fix Script
# Run this on the server

echo "=== Fixing Laravel Storage Permissions ==="

# Go to project directory
cd /home/godeepaf/public_html

# Create storage directories if they don't exist
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/testing
mkdir -p storage/logs
mkdir -p storage/app/public
mkdir -p bootstrap/cache

# Set ownership to web server user (usually www-data or apache)
chown -R godeepaf:godeepaf storage
chown -R godeepaf:godeepaf bootstrap/cache

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set proper file permissions
find storage -type f -exec chmod 664 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;

echo "=== Clearing All Caches ==="

# Clear all Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan clear-compiled

# Clear temp files
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*
rm -rf storage/framework/sessions/*
rm -rf bootstrap/cache/*.php

echo "=== Checking Disk Space ==="
df -h

echo "=== Checking Temp Directory ==="
df -h /tmp

echo "=== Done! ==="
echo "If still failing, check:"
echo "1. Disk space: df -h"
echo "2. Temp directory permissions: ls -la /tmp"
echo "3. PHP temp dir: php -r 'echo sys_get_temp_dir();'"
