@echo off
echo ================================================
echo Restaurant Backend - Quick Setup Script
echo ================================================
echo.

echo Step 1: Installing Composer dependencies...
composer install
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed. Make sure Composer is installed.
    pause
    exit /b 1
)
echo.

echo Step 2: Generating application key...
php artisan key:generate
echo.

echo Step 3: Checking database connection...
php artisan migrate:status
if %errorlevel% neq 0 (
    echo.
    echo WARNING: Cannot connect to database.
    echo Please ensure:
    echo  1. XAMPP MySQL is running
    echo  2. Database 'restaurant' exists in phpMyAdmin
    echo  3. Run the restaurant.sql file in phpMyAdmin
    echo.
    pause
)
echo.

echo ================================================
echo Setup Complete!
echo ================================================
echo.
echo To start the server, run:
echo   php artisan serve
echo.
echo The API will be available at:
echo   http://localhost:8000/api
echo.
echo Default admin login:
echo   Email: admin@restaurant.com
echo   Password: password
echo.
pause
