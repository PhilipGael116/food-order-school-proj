# Simple Backend Setup Guide

## What I Created For You

Since your Laravel backend was incomplete and Composer isn't installed, I've created a **simplified PHP backend** that works directly with XAMPP without any additional installations.

## Files Created:
- `backend-simple/index.php` - Main API file
- `backend-simple/setup.sql` - Database setup script

## Setup Steps:

### 1. Start XAMPP
- Open **XAMPP Control Panel**
- Click **Start** for **Apache**
- Click **Start** for **MySQL**

### 2. Create the Database
1. Open your browser and go to: `http://localhost/phpmyadmin`
2. Click on the **SQL** tab at the top
3. Copy the entire contents of `backend-simple/setup.sql`
4. Paste it into the SQL box
5. Click **Go** button

That's it! Your backend is now running.

### 3. Test Your Website
Open: `http://localhost/food-order-school-proj/static-pages/pages/home.php`

## How It Works:
- **Backend API**: `http://localhost/food-order-school-proj/backend-simple/`
- **Register/Login**: Automatically handled - just enter email and password
- **Orders**: Saved to your MySQL database

## Default Password for Testing:
The sample users have password: `password` (but you can register new ones)

## Troubleshooting:
If you get errors, make sure:
1. Apache and MySQL are both running in XAMPP
2. You ran the SQL script in phpMyAdmin
3. The database name is `restaurant`

Your frontend is already configured to use this new backend!
