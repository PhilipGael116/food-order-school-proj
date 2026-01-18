# Cameroonian Cuisine Delivery Website

A modern, fast, and authentic food ordering website for Cameroonian cuisine. This project features a stunning user interface built with HTML, CSS (Vanilla), Bootstrap, and Font Awesome, served via PHP.

## 🚀 Features

- **Dynamic Hero Section**: Featuring bike delivery badges and a curated grid of Cameroon's most famous meals (Jollof Rice, Eru, Ndole, Achu).
- **Smooth Navigation**: Premium header with hover effects and intuitive icons.
- **Service Schedule**: Clear display of opening hours, location, and contact info with glassmorphism effects.
- **Product Menu**: Diverse catalog of meals with high-quality images, descriptions, prices, and star ratings.
- **Interactive "How it Works"**: A visual guide to the ordering process, from choosing your meal to doorstep delivery.
- **Testimonials Carousel**: Real-time feedback from happy customers using a functional Bootstrap carousel.
- **Professional Footer**: Organized contact information, social links, and a newsletter subscription.

## 🛠️ Technology Stack

- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System)
- **Framework**: Bootstrap 5.3.3
- **Icons**: Font Awesome 7.0.1
- **Typography**: Google Fonts (Inter)
- **Backend**: PHP (Local Server Environment)
- **Development Tool**: XAMPP

## 📂 Project Structure

```text
food-order-school-proj/
├── static-pages/           # Main source directory
│   ├── components/         # Reusable PHP fragments (Header, Footer)
│   ├── pages/              # Main page files (home.php)
│   ├── images/             # Image assets (Logo, Meal images, Mockups)
│   └── index.css           # Global design system and styles
├── .agent/                 # Agent workflows
└── README.md               # Project documentation
```

## 🏁 Getting Started

1. **Prerequisites**: Ensure you have [XAMPP](https://www.apachefriends.org/index.html) installed on your machine.
2. **Setup**:
   - Clone or copy this repository into your XAMPP `htdocs` folder.
   - Start the **Apache** module from the XAMPP Control Panel.
3. **Run**:
   - Open your browser and navigate to `http://localhost/food-order-school-proj/static-pages/pages/home.php`.

## 🎨 Design Philosophy

The website uses a **Tangerine & Black** color palette to reflect the vibrant and spicy nature of Cameroonian food. Glassmorphism, subtle micro-animations, and custom SVG paths are used extensively to provide a premium, modern feel.

---
*Created with ❤️ for Cameroonian Food Lovers.*

# Restaurant Backend API

A comprehensive Laravel-based REST API for a restaurant food ordering system with complete CRUD operations, authentication, cart management, and order processing.

## 🚀 Features

- **User Authentication** (Registration, Login, Profile Management)
- **Menu Management** (Categories, Items with detailed info)
- **Shopping Cart** (Add, Update, Remove items)
- **Order Processing** (Place orders, Track status, Order history)
- **Review System** (Rate and review menu items)
- **Coupon System** (Discount codes and promotions)
- **Admin Panel** (Manage menu, orders, reviews)
- **Real-time Updates** (Order status tracking)
- **Image Support** (Menu item images)
- **Stock Management** (Track inventory)
- **Advanced Filtering** (Search, sort, filter menu items)

## 📋 Requirements

- PHP >= 8.1
- MySQL >= 5.7 or MariaDB >= 10.3
- Composer
- XAMPP (for local development)

## 🛠️ Installation

### Step 1: Setup Database

1. Start XAMPP and ensure Apache and MySQL are running
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Create a new database named `restaurant`

### Step 2: Install Laravel Project

1. Extract the backend files to your XAMPP htdocs folder:
   ```
   C:\xampp\htdocs\restaurant-backend
   ```

2. Open terminal/command prompt in the project directory

3. Install Composer dependencies:
   ```bash
   composer install
   ```

4. Copy environment file:
   ```bash
   copy .env.example .env
   ```
   (On Linux/Mac: `cp .env.example .env`)

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Configure database in `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=restaurant
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### Step 3: Setup Database Tables

1. Run migrations to create tables:
   ```bash
   php artisan migrate
   ```

2. Seed database with sample data:
   ```bash
   php artisan db:seed
   ```

### Step 4: Start Development Server

```bash
php artisan serve
```

The API will be available at: `http://localhost:8000`

## 🔐 Default Credentials

### Admin Account
- Email: `admin@restaurant.com`
- Password: `admin123`

### Customer Account
- Email: `customer@example.com`
- Password: `customer123`

## 📚 API Documentation

### Base URL
```
http://localhost:8000/api
```

### Authentication

All authenticated endpoints require a Bearer token in the header:
```
Authorization: Bearer {your_token}
```

---

### 🔓 Public Endpoints

#### 1. User Registration
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "+1234567890",
    "address": "123 Main Street"
}
```

#### 2. User Login
```http
POST /api/login
Content-Type: application/json

{
    "email": "customer@example.com",
    "password": "customer123"
}
```

#### 3. Get Categories
```http
GET /api/categories
```

#### 4. Get Menu Items
```http
GET /api/menu?category=appetizers&available=1&featured=1
```

**Available Filters:**
- `category` - Filter by category slug
- `available` - Show only available items
- `featured` - Show only featured items
- `vegetarian` - Show vegetarian items
- `vegan` - Show vegan items
- `search` - Search by name/description
- `sort_by` - Sort field (price, name, created_at)
- `sort_order` - asc or desc

#### 5. Get Single Menu Item
```http
GET /api/menu/{slug}
```

#### 6. Get Featured Items
```http
GET /api/menu/featured
```

#### 7. Get Menu Item Reviews
```http
GET /api/menu/{menuItemId}/reviews
```

---

### 🔒 Authenticated Endpoints

**All requests below require:**
```
Authorization: Bearer {token}
```

#### 8. Get Current User
```http
GET /api/me
```

#### 9. Update Profile
```http
PUT /api/profile
Content-Type: application/json

{
    "name": "John Updated",
    "phone": "+0987654321",
    "address": "456 New Street"
}
```

#### 10. Change Password
```http
PUT /api/change-password
Content-Type: application/json

{
    "current_password": "oldpass123",
    "new_password": "newpass123",
    "new_password_confirmation": "newpass123"
}
```

#### 11. Logout
```http
POST /api/logout
```

---

### 🛒 Cart Endpoints

#### 12. Get Cart
```http
GET /api/cart
```

#### 13. Add to Cart
```http
POST /api/cart
Content-Type: application/json

{
    "menu_item_id": 5,
    "quantity": 2,
    "special_instructions": "Extra cheese please"
}
```

#### 14. Update Cart Item
```http
PUT /api/cart/{id}
Content-Type: application/json

{
    "quantity": 3,
    "special_instructions": "Well done"
}
```

#### 15. Remove from Cart
```http
DELETE /api/cart/{id}
```

#### 16. Clear Cart
```http
DELETE /api/cart
```

---

### 📦 Order Endpoints

#### 17. Get Orders
```http
GET /api/orders
GET /api/orders?status=pending
```

#### 18. Get Single Order
```http
GET /api/orders/{id}
```

#### 19. Place Order
```http
POST /api/orders
Content-Type: application/json

{
    "delivery_address": "123 Main Street, City",
    "delivery_phone": "+1234567890",
    "payment_method": "cash",
    "notes": "Ring doorbell twice",
    "coupon_code": "WELCOME10"
}
```

**Payment Methods:** `cash`, `card`, `online`

#### 20. Cancel Order
```http
PUT /api/orders/{id}/cancel
```

---

### ⭐ Review Endpoints

#### 21. Submit Review
```http
POST /api/reviews
Content-Type: application/json

{
    "menu_item_id": 5,
    "rating": 5,
    "comment": "Absolutely delicious!"
}
```

---

### 👨‍💼 Admin Endpoints

**Requires admin role**

#### 22. Create Category
```http
POST /api/admin/categories
Content-Type: application/json

{
    "name": "New Category",
    "description": "Category description",
    "image": "category-image-url.jpg",
    "is_active": true,
    "order": 1
}
```

#### 23. Update Category
```http
PUT /api/admin/categories/{id}
```

#### 24. Delete Category
```http
DELETE /api/admin/categories/{id}
```

#### 25. Create Menu Item
```http
POST /api/admin/menu
Content-Type: application/json

{
    "category_id": 1,
    "name": "New Dish",
    "description": "Delicious new dish",
    "price": 19.99,
    "discount_price": 17.99,
    "is_available": true,
    "is_featured": false,
    "is_vegetarian": false,
    "preparation_time": 20,
    "calories": 450,
    "stock": 50
}
```

#### 26. Update Menu Item
```http
PUT /api/admin/menu/{id}
```

#### 27. Delete Menu Item
```http
DELETE /api/admin/menu/{id}
```

#### 28. Get All Orders (Admin)
```http
GET /api/admin/orders
GET /api/admin/orders?status=pending&date=2024-01-17
```

#### 29. Update Order Status
```http
PUT /api/admin/orders/{id}/status
Content-Type: application/json

{
    "status": "confirmed"
}
```

**Status Options:**
- `pending` → `confirmed` → `preparing` → `ready` → `out_for_delivery` → `delivered`
- `cancelled` (can be set at any time before delivery)

#### 30. Approve Review
```http
PUT /api/admin/reviews/{id}/approve
```

#### 31. Delete Review
```http
DELETE /api/admin/reviews/{id}
```

---

## 🔗 Frontend Integration Examples

### JavaScript (Vanilla)

```javascript
// Configuration
const API_URL = 'http://localhost:8000/api';

// Helper function
async function apiRequest(endpoint, options = {}) {
    const token = localStorage.getItem('token');
    const headers = {
        'Content-Type': 'application/json',
        ...options.headers,
    };
    
    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    const response = await fetch(`${API_URL}${endpoint}`, {
        ...options,
        headers,
    });

    return await response.json();
}

// Login
async function login(email, password) {
    const data = await apiRequest('/login', {
        method: 'POST',
        body: JSON.stringify({ email, password })
    });
    
    if (data.success) {
        localStorage.setItem('token', data.data.token);
        localStorage.setItem('user', JSON.stringify(data.data.user));
    }
    
    return data;
}

// Get menu items
async function getMenu(filters = {}) {
    const params = new URLSearchParams(filters);
    return await apiRequest(`/menu?${params}`);
}

// Add to cart
async function addToCart(menuItemId, quantity, specialInstructions = '') {
    return await apiRequest('/cart', {
        method: 'POST',
        body: JSON.stringify({
            menu_item_id: menuItemId,
            quantity,
            special_instructions: specialInstructions
        })
    });
}

// Place order
async function placeOrder(orderData) {
    return await apiRequest('/orders', {
        method: 'POST',
        body: JSON.stringify(orderData)
    });
}

// Usage
login('customer@example.com', 'customer123')
    .then(data => console.log('Logged in:', data));

getMenu({ category: 'appetizers', available: 1 })
    .then(data => console.log('Menu:', data));
```

### React

```javascript
// services/api.js
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        'Content-Type': 'application/json',
    }
});

// Request interceptor
api.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

// Response interceptor
api.interceptors.response.use(
    response => response.data,
    error => {
        if (error.response?.status === 401) {
            localStorage.removeItem('token');
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);

export const authService = {
    login: (credentials) => api.post('/login', credentials),
    register: (userData) => api.post('/register', userData),
    logout: () => api.post('/logout'),
    getProfile: () => api.get('/me'),
};

export const menuService = {
    getAll: (params) => api.get('/menu', { params }),
    getBySlug: (slug) => api.get(`/menu/${slug}`),
    getFeatured: () => api.get('/menu/featured'),
};

export const cartService = {
    get: () => api.get('/cart'),
    add: (data) => api.post('/cart', data),
    update: (id, data) => api.put(`/cart/${id}`, data),
    remove: (id) => api.delete(`/cart/${id}`),
    clear: () => api.delete('/cart'),
};

export const orderService = {
    getAll: (params) => api.get('/orders', { params }),
    getById: (id) => api.get(`/orders/${id}`),
    create: (data) => api.post('/orders', data),
    cancel: (id) => api.put(`/orders/${id}/cancel`),
};

// Component usage
import React, { useEffect, useState } from 'react';
import { menuService, cartService } from './services/api';

function MenuPage() {
    const [menuItems, setMenuItems] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        loadMenu();
    }, []);

    const loadMenu = async () => {
        try {
            const data = await menuService.getAll({ available: 1 });
            setMenuItems(data.data);
        } catch (error) {
            console.error('Error loading menu:', error);
        } finally {
            setLoading(false);
        }
    };

    const handleAddToCart = async (menuItemId) => {
        try {
            await cartService.add({
                menu_item_id: menuItemId,
                quantity: 1
            });
            alert('Added to cart!');
        } catch (error) {
            console.error('Error adding to cart:', error);
        }
    };

    if (loading) return <div>Loading...</div>;

    return (
        <div>
            {menuItems.map(item => (
                <div key={item.id}>
                    <h3>{item.name}</h3>
                    <p>{item.description}</p>
                    <p>${item.final_price}</p>
                    <button onClick={() => handleAddToCart(item.id)}>
                        Add to Cart
                    </button>
                </div>
            ))}
        </div>
    );
}
```

### Vue.js

```javascript
// services/api.js
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
});

api.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export default {
    // Auth
    login(credentials) {
        return api.post('/login', credentials);
    },
    register(userData) {
        return api.post('/register', userData);
    },
    
    // Menu
    getMenu(params = {}) {
        return api.get('/menu', { params });
    },
    getMenuItem(slug) {
        return api.get(`/menu/${slug}`);
    },
    
    // Cart
    getCart() {
        return api.get('/cart');
    },
    addToCart(data) {
        return api.post('/cart', data);
    },
    
    // Orders
    placeOrder(data) {
        return api.post('/orders', data);
    },
    getOrders() {
        return api.get('/orders');
    },
};

// Component usage
// MenuList.vue
<template>
  <div>
    <div v-for="item in menuItems" :key="item.id" class="menu-item">
      <h3>{{ item.name }}</h3>
      <p>{{ item.description }}</p>
      <p>${{ item.final_price }}</p>
      <button @click="addToCart(item.id)">Add to Cart</button>
    </div>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  data() {
    return {
      menuItems: [],
    };
  },
  mounted() {
    this.loadMenu();
  },
  methods: {
    async loadMenu() {
      try {
        const response = await api.getMenu({ available: 1 });
        this.menuItems = response.data.data;
      } catch (error) {
        console.error('Error loading menu:', error);
      }
    },
    async addToCart(menuItemId) {
      try {
        await api.addToCart({
          menu_item_id: menuItemId,
          quantity: 1,
        });
        this.$toast.success('Added to cart!');
      } catch (error) {
        this.$toast.error('Error adding to cart');
      }
    },
  },
};
</script>
```

### Angular

```typescript
// services/api.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private baseUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) {}

  private getHeaders(): HttpHeaders {
    const token = localStorage.getItem('token');
    let headers = new HttpHeaders({
      'Content-Type': 'application/json'
    });
    
    if (token) {
      headers = headers.set('Authorization', `Bearer ${token}`);
    }
    
    return headers;
  }

  // Auth
  login(credentials: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/login`, credentials);
  }

  register(userData: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/register`, userData);
  }

  // Menu
  getMenu(params?: any): Observable<any> {
    let httpParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(key => {
        httpParams = httpParams.set(key, params[key]);
      });
    }
    
    return this.http.get(`${this.baseUrl}/menu`, {
      headers: this.getHeaders(),
      params: httpParams
    });
  }

  getMenuItem(slug: string): Observable<any> {
    return this.http.get(`${this.baseUrl}/menu/${slug}`, {
      headers: this.getHeaders()
    });
  }

  // Cart
  getCart(): Observable<any> {
    return this.http.get(`${this.baseUrl}/cart`, {
      headers: this.getHeaders()
    });
  }

  addToCart(data: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/cart`, data, {
      headers: this.getHeaders()
    });
  }

  // Orders
  placeOrder(data: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/orders`, data, {
      headers: this.getHeaders()
    });
  }

  getOrders(): Observable<any> {
    return this.http.get(`${this.baseUrl}/orders`, {
      headers: this.getHeaders()
    });
  }
}

// Component usage
// menu.component.ts
import { Component, OnInit } from '@angular/core';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html'
})
export class MenuComponent implements OnInit {
  menuItems: any[] = [];
  loading = true;

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadMenu();
  }

  loadMenu() {
    this.apiService.getMenu({ available: 1 }).subscribe({
      next: (response) => {
        this.menuItems = response.data;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error loading menu:', error);
        this.loading = false;
      }
    });
  }

  addToCart(menuItemId: number) {
    this.apiService.addToCart({
      menu_item_id: menuItemId,
      quantity: 1
    }).subscribe({
      next: () => {
        alert('Added to cart!');
      },
      error: (error) => {
        console.error('Error:', error);
      }
    });
  }
}
```

---

## 🧪 Testing the API

### Postman Collection

1. Create a new collection in Postman
2. Set base URL variable: `{{base_url}}` = `http://localhost:8000/api`
3. Add Bearer token in Authorization tab for authenticated requests

### Sample cURL Commands

```bash
# Register
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'

# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"customer@example.com","password":"customer123"}'

# Get menu (replace TOKEN)
curl -X GET http://localhost:8000/api/menu \
  -H "Authorization: Bearer TOKEN"

# Add to cart
curl -X POST http://localhost:8000/api/cart \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"menu_item_id":1,"quantity":2}'

# Place order
curl -X POST http://localhost:8000/api/orders \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "delivery_address": "123 Main St",
    "delivery_phone": "+1234567890",
    "payment_method": "cash"
  }'
```

---

## 📁 Project Structure

```
restaurant-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   ├── AuthController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── MenuItemController.php
│   │   │   ├── CartController.php
│   │   │   ├── OrderController.php
│   │   │   └── ReviewController.php
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   └── Cors.php
│   │   └── Kernel.php
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       ├── MenuItem.php
│       ├── Cart.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Review.php
│       └── Coupon.php
├── database/
│   ├── migrations/
│   │   └── 2024_01_01_000000_create_restaurant_tables.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── routes/
│   └── api.php
├── .env.example
├── composer.json
└── README.md
```

---

## 🐛 Troubleshooting

### Common Issues

**1. Database Connection Error**
```
SQLSTATE[HY000] [1045] Access denied
```
Solution:
- Check MySQL is running in XAMPP
- Verify database name is `restaurant`
- Check `.env` credentials (default: root with no password)

**2. Class Not Found**
```
Class 'App\Http\Controllers\...' not found
```
Solution:
```bash
composer dump-autoload
php artisan clear-compiled
php artisan config:clear
```

**3. Token Mismatch**
```
419 Page Expired
```
Solution:
```bash
php artisan key:generate
php artisan cache:clear
php artisan config:clear
```

**4. Migration Error**
```
SQLSTATE[42S01]: Base table or view already exists
```
Solution:
```bash
php artisan migrate:fresh
php artisan db:seed
```

**5. CORS Error in Frontend**
```
Access to fetch blocked by CORS policy
```
Solution: The API already has CORS enabled. Make sure you're using correct headers.

---

## 📊 Database Schema

### Tables

**users**
- id, name, email, password, phone, address, role, timestamps

**categories**
- id, name, slug, description, image, is_active, order, timestamps

**menu_items**
- id, category_id, name, slug, description, price, discount_price, image, images, is_available, is_featured, is_vegetarian, is_vegan, preparation_time, calories, allergens, ingredients, stock, timestamps

**orders**
- id, user_id, order_number, status, payment_status, payment_method, subtotal, tax, delivery_fee, discount, total, delivery_address, delivery_phone, notes, estimated_delivery_time, delivered_at, timestamps

**order_items**
- id, order_id, menu_item_id, item_name, quantity, price, special_instructions, timestamps

**carts**
- id, user_id, menu_item_id, quantity, special_instructions, timestamps

**reviews**
- id, user_id, menu_item_id, rating, comment, is_approved, timestamps

**coupons**
- id, code, type, value, min_order_amount, usage_limit, used_count, valid_from, valid_until, is_active, timestamps

---

## 🚀 Quick Start Commands

```bash
# Initial setup
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

# Start server
php artisan serve

# Reset database
php artisan migrate:fresh --seed

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

---

## 📝 Sample Coupon Codes

- **WELCOME10** - 10% off orders over $20
- **SAVE5** - $5 off orders over $30

---

## 🎉 You're All Set!

Your restaurant backend API is now running and ready to accept requests. Connect your frontend application using the integration examples provided above.

**API Base URL:** `http://localhost:8000/api`

For any questions or issues, refer to the troubleshooting section or check the Laravel logs.
