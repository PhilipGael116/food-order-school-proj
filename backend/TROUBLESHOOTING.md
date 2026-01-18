# Troubleshooting Guide

Common issues and solutions for the Restaurant Backend API.

---

## Database Issues

### ❌ "SQLSTATE[HY000] [1049] Unknown database 'restaurant'"

**Problem:** Database doesn't exist

**Solution:**
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click "New" in the left sidebar
3. Database name: `restaurant`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"
6. Then import the `database/restaurant.sql` file

---

### ❌ "SQLSTATE[HY000] [2002] No connection could be made"

**Problem:** MySQL is not running

**Solution:**
1. Open XAMPP Control Panel
2. Click "Start" next to MySQL
3. Wait for it to turn green
4. Try again

---

### ❌ "Access denied for user 'root'@'localhost'"

**Problem:** MySQL password mismatch

**Solution:**
1. Check your MySQL password in XAMPP
2. Update `.env` file:
   ```
   DB_PASSWORD=your_actual_password
   ```
3. Restart the server

---

## Installation Issues

### ❌ "composer: command not found"

**Problem:** Composer not installed

**Solution:**
1. Download Composer from: https://getcomposer.org/download/
2. Install it globally
3. Restart your terminal
4. Run `composer --version` to verify

---

### ❌ "Your requirements could not be resolved"

**Problem:** PHP version or extension missing

**Solution:**
1. Check PHP version: `php -v` (must be 8.1+)
2. Install missing extensions in XAMPP
3. Enable required extensions in `php.ini`:
   - extension=pdo_mysql
   - extension=mbstring
   - extension=openssl
   - extension=tokenizer
   - extension=xml
   - extension=ctype
   - extension=json

---

### ❌ "Class 'Illuminate\Foundation\Application' not found"

**Problem:** Dependencies not installed

**Solution:**
```bash
composer install
composer dump-autoload
```

---

## Server Issues

### ❌ "Address already in use"

**Problem:** Port 8000 is occupied

**Solution:**
Run on a different port:
```bash
php artisan serve --port=8080
```

Then update API URL in frontend to: `http://localhost:8080/api`

---

### ❌ 404 errors on all API routes

**Problem:** Routing not working

**Solution:**
1. Make sure you're using `/api/` in the URL
2. Check `routes/api.php` exists
3. Clear route cache:
   ```bash
   php artisan route:clear
   php artisan cache:clear
   php artisan config:clear
   ```

---

## Authentication Issues

### ❌ "Unauthenticated" error

**Problem:** Token not sent or invalid

**Solution:**
1. Check the Authorization header is included:
   ```
   Authorization: Bearer YOUR_TOKEN
   ```
2. Make sure token is not expired
3. Try logging in again to get a fresh token

---

### ❌ "Token Mismatch" or "CSRF Token Mismatch"

**Problem:** CSRF protection enabled (should not happen in API)

**Solution:**
This API doesn't use CSRF tokens. If you see this, you may be hitting the wrong endpoint. Make sure you're using `/api/` routes.

---

## CORS Issues

### ❌ "CORS policy: No 'Access-Control-Allow-Origin' header"

**Problem:** Frontend can't access API

**Solution:**
1. Make sure frontend URL is in `.env`:
   ```
   CORS_ALLOWED_ORIGINS=http://localhost:3000,http://localhost:5173
   ```
2. Check CORS middleware is active in `app/Http/Kernel.php`
3. Restart the server

---

### ❌ "Access to fetch blocked by CORS policy"

**Problem:** Preflight request failing

**Solution:**
Add your frontend URL to allowed origins:
```env
CORS_ALLOWED_ORIGINS=http://localhost:3000
```

---

## Data Issues

### ❌ "The given data was invalid" errors

**Problem:** Validation failed

**Solution:**
Check the API documentation for required fields. Common validation rules:

**Register:**
- email must be unique and valid format
- password minimum 6 characters
- password_confirmation must match password

**Create Order:**
- items array required with at least 1 item
- menu_item_id must exist
- quantity must be positive integer
- delivery_address required
- customer_phone required

**Create Menu Item:**
- price must be numeric and positive
- category_id must exist

---

### ❌ "Foreign key constraint fails"

**Problem:** Referenced data doesn't exist

**Solution:**
Make sure parent records exist:
- Category must exist before creating menu items
- Menu item must exist before ordering
- User must exist before creating order

---

## Performance Issues

### ❌ Slow API responses

**Problem:** Large database or inefficient queries

**Solution:**
1. Add indexes to frequently queried columns
2. Use eager loading for relationships
3. Enable query caching
4. Optimize database queries

---

### ❌ Timeout errors

**Problem:** Request taking too long

**Solution:**
1. Increase PHP max_execution_time in `php.ini`
2. Optimize database queries
3. Add pagination to large datasets

---

## Frontend Integration Issues

### ❌ Can't connect from React/Vue app

**Problem:** URL or CORS issue

**Solution:**
1. Verify backend is running: `http://localhost:8000/api/health`
2. Check API URL in frontend code
3. Ensure CORS is properly configured
4. Check browser console for specific errors

---

### ❌ Getting HTML instead of JSON response

**Problem:** Hitting wrong endpoint

**Solution:**
1. Make sure URL includes `/api/`
2. Correct: `http://localhost:8000/api/menu-items`
3. Wrong: `http://localhost:8000/menu-items`

---

## File Permission Issues (Linux/Mac)

### ❌ "Permission denied" errors

**Problem:** Laravel can't write to directories

**Solution:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

Or if running with current user:
```bash
chmod -R 775 storage bootstrap/cache
```

---

## Common Error Messages Explained

### "Call to undefined function App\Http\Controllers\str()"

**Solution:** Use `Str::` facade or helper:
```php
use Illuminate\Support\Str;
Str::slug($string);
```

### "Trying to get property of non-object"

**Solution:** Use null-safe operators or check before accessing:
```php
$value = $object?->property;
// or
if ($object) {
    $value = $object->property;
}
```

### "Too few arguments to function"

**Solution:** Check function signature and pass all required parameters

---

## Testing Checklist

Before reporting an issue, verify:

- [ ] XAMPP Apache and MySQL are running
- [ ] Database 'restaurant' exists
- [ ] Composer dependencies installed (`composer install`)
- [ ] Application key generated (`php artisan key:generate`)
- [ ] Database tables created (import `restaurant.sql`)
- [ ] Server is running (`php artisan serve`)
- [ ] Hitting correct endpoint with `/api/` prefix
- [ ] Authorization header included for protected routes
- [ ] Request body is valid JSON
- [ ] Content-Type header is `application/json`

---

## Getting Help

### Check Logs

Laravel logs are in `storage/logs/laravel.log`

View last 50 lines:
```bash
# Windows
type storage\logs\laravel.log | more

# Linux/Mac
tail -n 50 storage/logs/laravel.log
```

### Enable Debug Mode

In `.env`:
```env
APP_DEBUG=true
```

**Warning:** Never enable in production!

### Database Query Logging

Add to any controller method:
```php
\DB::enableQueryLog();
// Your code here
dd(\DB::getQueryLog());
```

---

## Still Having Issues?

1. **Check the logs**: `storage/logs/laravel.log`
2. **Verify environment**: `php artisan env` 
3. **Clear all caches**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```
4. **Reinstall dependencies**:
   ```bash
   rm -rf vendor
   composer install
   ```
5. **Reset database**:
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## Quick Fixes

**Reset everything:**
```bash
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Reinstall
composer dump-autoload

# Restart server
php artisan serve
```

**Database fresh start:**
```bash
# Drop and recreate tables
php artisan migrate:fresh --seed
```

---

## Prevention Tips

1. **Always check `.env` file** after setup
2. **Run migrations** after creating new migration files
3. **Clear cache** after configuration changes
4. **Use try-catch** blocks in frontend API calls
5. **Validate data** before sending to API
6. **Check API documentation** for required fields
7. **Use Postman** to test endpoints before integrating
8. **Keep dependencies updated** with `composer update`

---

Remember: Most issues are configuration or setup related. Follow the installation guide carefully and check each step!
