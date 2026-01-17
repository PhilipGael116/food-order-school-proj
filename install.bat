@echo off
echo ========================================
echo Restaurant Backend API - Installation
echo ========================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Composer is not installed!
    echo Please install Composer from https://getcomposer.org/
    pause
    exit /b 1
)

echo [1/6] Installing Composer dependencies...
call composer install
if %ERRORLEVEL% NEQ 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo.
echo [2/6] Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo .env file created
) else (
    echo .env file already exists
)

echo.
echo [3/6] Generating application key...
call php artisan key:generate

echo.
echo [4/6] Creating database tables...
call php artisan migrate
if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ERROR: Migration failed!
    echo Please ensure:
    echo 1. XAMPP MySQL is running
    echo 2. Database 'restaurant' exists in phpMyAdmin
    echo 3. Database credentials in .env are correct
    pause
    exit /b 1
)

echo.
echo [5/6] Seeding database with sample data...
call php artisan db:seed

echo.
echo [6/6] Clearing caches...
call php artisan config:clear
call php artisan cache:clear
call php artisan route:clear

echo.
echo ========================================
echo Installation Complete!
echo ========================================
echo.
echo Default Credentials:
echo Admin: admin@restaurant.com / admin123
echo Customer: customer@example.com / customer123
echo.
echo To start the server, run:
echo php artisan serve
echo.
echo API will be available at: http://localhost:8000/api
echo.
pause
