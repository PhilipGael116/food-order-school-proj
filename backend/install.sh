#!/bin/bash

echo "========================================"
echo "Restaurant Backend API - Installation"
echo "========================================"
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "ERROR: Composer is not installed!"
    echo "Please install Composer from https://getcomposer.org/"
    exit 1
fi

echo "[1/6] Installing Composer dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed!"
    exit 1
fi

echo ""
echo "[2/6] Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo ".env file created"
else
    echo ".env file already exists"
fi

echo ""
echo "[3/6] Generating application key..."
php artisan key:generate

echo ""
echo "[4/6] Creating database tables..."
php artisan migrate
if [ $? -ne 0 ]; then
    echo ""
    echo "ERROR: Migration failed!"
    echo "Please ensure:"
    echo "1. MySQL is running"
    echo "2. Database 'restaurant' exists"
    echo "3. Database credentials in .env are correct"
    exit 1
fi

echo ""
echo "[5/6] Seeding database with sample data..."
php artisan db:seed

echo ""
echo "[6/6] Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear

echo ""
echo "========================================"
echo "Installation Complete!"
echo "========================================"
echo ""
echo "Default Credentials:"
echo "Admin: admin@restaurant.com / admin123"
echo "Customer: customer@example.com / customer123"
echo ""
echo "To start the server, run:"
echo "php artisan serve"
echo ""
echo "API will be available at: http://localhost:8000/api"
echo ""
