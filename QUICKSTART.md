# Quick Start Guide

## 🚀 5-Minute Setup

### Prerequisites
- ✅ XAMPP installed and running
- ✅ Composer installed
- ✅ PHP 8.1 or higher

### Step-by-Step Installation

**1. Create Database**
- Open XAMPP Control Panel
- Start Apache and MySQL
- Click "Admin" next to MySQL (opens phpMyAdmin)
- Click "New" to create database
- Name it: `restaurant`
- Click "Create"

**2. Extract Files**
- Extract this folder to: `C:\xampp\htdocs\restaurant-backend`

**3. Run Installation Script**

**Windows:**
```batch
Double-click: install.bat
```

**Mac/Linux:**
```bash
chmod +x install.sh
./install.sh
```

**Manual Installation:**
```bash
composer install
copy .env.example .env    # Windows
cp .env.example .env      # Mac/Linux
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

**4. Start Server**
```bash
php artisan serve
```

API is now running at: `http://localhost:8000/api`

---

## 🧪 Test Your Installation

### Test in Browser
Open: `http://localhost:8000/api/categories`

You should see JSON response with restaurant categories.

### Test with cURL
```bash
curl http://localhost:8000/api/menu
```

### Test Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d "{\"email\":\"customer@example.com\",\"password\":\"customer123\"}"
```

---

## 🔑 Default Accounts

### Customer Account
```
Email: customer@example.com
Password: customer123
```

### Admin Account
```
Email: admin@restaurant.com
Password: admin123
```

---

## 📱 Frontend Connection

### JavaScript Example
```javascript
// Login and get token
fetch('http://localhost:8000/api/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        email: 'customer@example.com',
        password: 'customer123'
    })
})
.then(res => res.json())
.then(data => {
    console.log('Token:', data.data.token);
    localStorage.setItem('token', data.data.token);
});

// Get menu items
const token = localStorage.getItem('token');
fetch('http://localhost:8000/api/menu', {
    headers: {
        'Authorization': `Bearer ${token}`
    }
})
.then(res => res.json())
.then(data => console.log('Menu:', data));
```

### React Example
```javascript
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api'
});

// Add token to all requests
api.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

// Login
const login = async (email, password) => {
    const { data } = await api.post('/login', { email, password });
    localStorage.setItem('token', data.data.token);
    return data;
};

// Get menu
const getMenu = () => api.get('/menu');

// Add to cart
const addToCart = (menuItemId, quantity) => {
    return api.post('/cart', {
        menu_item_id: menuItemId,
        quantity
    });
};
```

---

## 🎯 Common API Calls

### Get Menu
```
GET http://localhost:8000/api/menu
```

### Add to Cart (requires login)
```
POST http://localhost:8000/api/cart
Headers: Authorization: Bearer {token}
Body: {
    "menu_item_id": 1,
    "quantity": 2
}
```

### Place Order (requires login)
```
POST http://localhost:8000/api/orders
Headers: Authorization: Bearer {token}
Body: {
    "delivery_address": "123 Main St",
    "delivery_phone": "+1234567890",
    "payment_method": "cash"
}
```

---

## 🛠️ Troubleshooting

### Server won't start
```bash
# Check if port 8000 is free
netstat -ano | findstr :8000

# Use different port
php artisan serve --port=8001
```

### Database connection error
1. Ensure MySQL is running in XAMPP
2. Check database name is `restaurant`
3. Verify `.env` settings:
   ```
   DB_DATABASE=restaurant
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

### Clear All Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

---

## 📚 Next Steps

1. Read `README.md` for complete API documentation
2. Import `postman_collection.json` into Postman for testing
3. Build your frontend using the integration examples
4. Customize menu items and categories through admin endpoints

---

## 🆘 Need Help?

- Check `README.md` for full documentation
- Review Laravel logs: `storage/logs/laravel.log`
- Ensure XAMPP MySQL is running
- Verify database exists and is named `restaurant`

---

## ✅ Success Indicators

You'll know everything is working when:
- ✅ Server starts without errors
- ✅ Browser shows JSON at http://localhost:8000/api/categories
- ✅ Login returns a token
- ✅ Can add items to cart
- ✅ Can place orders

Happy coding! 🎉
