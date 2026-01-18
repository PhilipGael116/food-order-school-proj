#!/bin/bash

echo "================================================"
echo "Restaurant Backend - Quick Setup Script"
echo "================================================"
echo ""

echo "Step 1: Installing Composer dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed. Make sure Composer is installed."
    exit 1
fi
echo ""

echo "Step 2: Generating application key..."
php artisan key:generate
echo ""

echo "Step 3: Setting permissions..."
chmod -R 775 storage bootstrap/cache
echo ""

echo "Step 4: Checking database connection..."
php artisan migrate:status
if [ $? -ne 0 ]; then
    echo ""
    echo "WARNING: Cannot connect to database."
    echo "Please ensure:"
    echo "  1. MySQL is running"
    echo "  2. Database 'restaurant' exists"
    echo "  3. Run the restaurant.sql file"
    echo ""
fi
echo ""

echo "================================================"
echo "Setup Complete!"
echo "================================================"
echo ""
echo "To start the server, run:"
echo "  php artisan serve"
echo ""
echo "The API will be available at:"
echo "  http://localhost:8000/api"
echo ""
echo "Default admin login:"
echo "  Email: admin@restaurant.com"
echo "  Password: password"
echo ""
