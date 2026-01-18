# Frontend Integration Guide

## Quick Start Integration Examples

This guide shows you how to integrate the Restaurant Backend API with various frontend frameworks.

---

## 🌐 Vanilla JavaScript / HTML

### Complete Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Menu</title>
    <style>
        .menu-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
        }
        .menu-item img {
            width: 100%;
            max-width: 300px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Our Menu</h1>
    <div id="menu-container"></div>
    <div id="cart"></div>
    <button onclick="checkout()">Checkout</button>

    <script>
        const API_URL = 'http://localhost:8000/api';
        let cart = [];
        let token = localStorage.getItem('token');

        // Fetch and display menu items
        async function loadMenu() {
            try {
                const response = await fetch(`${API_URL}/menu-items`);
                const result = await response.json();
                
                if (result.success) {
                    displayMenu(result.data);
                }
            } catch (error) {
                console.error('Error loading menu:', error);
            }
        }

        function displayMenu(items) {
            const container = document.getElementById('menu-container');
            container.innerHTML = items.map(item => `
                <div class="menu-item">
                    <img src="${item.image}" alt="${item.name}">
                    <h3>${item.name}</h3>
                    <p>${item.description}</p>
                    <p><strong>$${item.price}</strong></p>
                    <button onclick="addToCart(${item.id}, '${item.name}', ${item.price})">
                        Add to Cart
                    </button>
                </div>
            `).join('');
        }

        function addToCart(id, name, price) {
            const existing = cart.find(item => item.menu_item_id === id);
            if (existing) {
                existing.quantity++;
            } else {
                cart.push({
                    menu_item_id: id,
                    name: name,
                    price: price,
                    quantity: 1
                });
            }
            updateCartDisplay();
        }

        function updateCartDisplay() {
            const cartDiv = document.getElementById('cart');
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            cartDiv.innerHTML = `
                <h2>Cart</h2>
                ${cart.map(item => `
                    <p>${item.name} x ${item.quantity} = $${(item.price * item.quantity).toFixed(2)}</p>
                `).join('')}
                <p><strong>Total: $${total.toFixed(2)}</strong></p>
            `;
        }

        async function checkout() {
            if (!token) {
                alert('Please login first!');
                return;
            }

            const orderData = {
                items: cart.map(item => ({
                    menu_item_id: item.menu_item_id,
                    quantity: item.quantity
                })),
                delivery_address: "123 Main Street",
                customer_phone: "1234567890",
                payment_method: "cash"
            };

            try {
                const response = await fetch(`${API_URL}/orders`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify(orderData)
                });

                const result = await response.json();
                
                if (result.success) {
                    alert(`Order placed! Order #${result.data.order_number}`);
                    cart = [];
                    updateCartDisplay();
                } else {
                    alert('Order failed: ' + result.message);
                }
            } catch (error) {
                console.error('Error placing order:', error);
            }
        }

        // Login function
        async function login(email, password) {
            const response = await fetch(`${API_URL}/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            const result = await response.json();
            
            if (result.success) {
                token = result.data.token;
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(result.data.user));
                return true;
            }
            return false;
        }

        // Load menu on page load
        loadMenu();
    </script>
</body>
</html>
```

---

## ⚛️ React Integration

### 1. Setup API Service

**src/services/api.js**
```javascript
import axios from 'axios';

const API = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        'Content-Type': 'application/json',
    },
});

// Add token to all requests
API.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

// Handle errors globally
API.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            localStorage.removeItem('token');
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);

// Auth endpoints
export const authAPI = {
    login: (credentials) => API.post('/login', credentials),
    register: (userData) => API.post('/register', userData),
    logout: () => API.post('/logout'),
    me: () => API.get('/me'),
};

// Menu endpoints
export const menuAPI = {
    getCategories: () => API.get('/categories'),
    getMenuItems: (params) => API.get('/menu-items', { params }),
    getMenuItem: (slug) => API.get(`/menu-items/${slug}`),
};

// Order endpoints
export const orderAPI = {
    getOrders: () => API.get('/orders'),
    createOrder: (orderData) => API.post('/orders', orderData),
    getOrder: (id) => API.get(`/orders/${id}`),
    cancelOrder: (id) => API.post(`/orders/${id}/cancel`),
};

export default API;
```

### 2. Authentication Context

**src/context/AuthContext.jsx**
```javascript
import React, { createContext, useState, useContext, useEffect } from 'react';
import { authAPI } from '../services/api';

const AuthContext = createContext();

export const useAuth = () => useContext(AuthContext);

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        checkAuth();
    }, []);

    const checkAuth = async () => {
        const token = localStorage.getItem('token');
        if (token) {
            try {
                const response = await authAPI.me();
                setUser(response.data.data);
            } catch (error) {
                localStorage.removeItem('token');
            }
        }
        setLoading(false);
    };

    const login = async (email, password) => {
        const response = await authAPI.login({ email, password });
        if (response.data.success) {
            localStorage.setItem('token', response.data.data.token);
            setUser(response.data.data.user);
            return true;
        }
        return false;
    };

    const logout = async () => {
        try {
            await authAPI.logout();
        } catch (error) {
            console.error('Logout error:', error);
        }
        localStorage.removeItem('token');
        setUser(null);
    };

    return (
        <AuthContext.Provider value={{ user, login, logout, loading }}>
            {children}
        </AuthContext.Provider>
    );
};
```

### 3. Menu Component Example

**src/components/Menu.jsx**
```javascript
import React, { useState, useEffect } from 'react';
import { menuAPI } from '../services/api';

function Menu() {
    const [menuItems, setMenuItems] = useState([]);
    const [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        loadData();
    }, []);

    const loadData = async () => {
        try {
            const [categoriesRes, itemsRes] = await Promise.all([
                menuAPI.getCategories(),
                menuAPI.getMenuItems(),
            ]);

            setCategories(categoriesRes.data.data);
            setMenuItems(itemsRes.data.data);
        } catch (error) {
            console.error('Error loading menu:', error);
        } finally {
            setLoading(false);
        }
    };

    const filterByCategory = async (categoryId) => {
        setSelectedCategory(categoryId);
        const response = await menuAPI.getMenuItems({ category_id: categoryId });
        setMenuItems(response.data.data);
    };

    if (loading) return <div>Loading...</div>;

    return (
        <div className="menu-page">
            <h1>Our Menu</h1>
            
            <div className="categories">
                <button onClick={() => loadData()}>All</button>
                {categories.map(cat => (
                    <button 
                        key={cat.id}
                        onClick={() => filterByCategory(cat.id)}
                        className={selectedCategory === cat.id ? 'active' : ''}
                    >
                        {cat.name}
                    </button>
                ))}
            </div>

            <div className="menu-items">
                {menuItems.map(item => (
                    <div key={item.id} className="menu-item">
                        <img src={item.image} alt={item.name} />
                        <h3>{item.name}</h3>
                        <p>{item.description}</p>
                        <p className="price">${item.price}</p>
                        <button onClick={() => addToCart(item)}>
                            Add to Cart
                        </button>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default Menu;
```

### 4. Cart & Checkout Component

**src/components/Checkout.jsx**
```javascript
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { orderAPI } from '../services/api';

function Checkout({ cart, clearCart }) {
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        delivery_address: '',
        customer_phone: '',
        payment_method: 'cash',
        notes: '',
    });

    const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

    const handleSubmit = async (e) => {
        e.preventDefault();

        const orderData = {
            items: cart.map(item => ({
                menu_item_id: item.id,
                quantity: item.quantity,
                special_instructions: item.notes || null,
            })),
            ...formData,
        };

        try {
            const response = await orderAPI.createOrder(orderData);
            if (response.data.success) {
                alert(`Order placed! Order #${response.data.data.order_number}`);
                clearCart();
                navigate(`/orders/${response.data.data.id}`);
            }
        } catch (error) {
            alert('Order failed: ' + error.response?.data?.message);
        }
    };

    return (
        <div className="checkout">
            <h2>Checkout</h2>
            
            <div className="cart-summary">
                <h3>Your Order</h3>
                {cart.map(item => (
                    <div key={item.id}>
                        {item.name} x {item.quantity} = ${(item.price * item.quantity).toFixed(2)}
                    </div>
                ))}
                <h3>Total: ${total.toFixed(2)}</h3>
            </div>

            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    placeholder="Delivery Address"
                    required
                    value={formData.delivery_address}
                    onChange={(e) => setFormData({...formData, delivery_address: e.target.value})}
                />
                
                <input
                    type="tel"
                    placeholder="Phone Number"
                    required
                    value={formData.customer_phone}
                    onChange={(e) => setFormData({...formData, customer_phone: e.target.value})}
                />

                <select 
                    value={formData.payment_method}
                    onChange={(e) => setFormData({...formData, payment_method: e.target.value})}
                >
                    <option value="cash">Cash on Delivery</option>
                    <option value="card">Card</option>
                    <option value="online">Online Payment</option>
                </select>

                <textarea
                    placeholder="Special Instructions (optional)"
                    value={formData.notes}
                    onChange={(e) => setFormData({...formData, notes: e.target.value})}
                />

                <button type="submit">Place Order</button>
            </form>
        </div>
    );
}

export default Checkout;
```

---

## 🖼️ Vue.js Integration

### 1. Setup API Service

**src/services/api.js**
```javascript
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
});

api.interceptors.request.use((config) => {
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
    getMenuItems(params) {
        return api.get('/menu-items', { params });
    },
    getCategories() {
        return api.get('/categories');
    },
    
    // Orders
    createOrder(orderData) {
        return api.post('/orders', orderData);
    },
    getOrders() {
        return api.get('/orders');
    },
};
```

### 2. Vuex Store (Optional)

**src/store/index.js**
```javascript
import { createStore } from 'vuex';
import api from '../services/api';

export default createStore({
    state: {
        user: null,
        cart: [],
        menuItems: [],
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        ADD_TO_CART(state, item) {
            const existing = state.cart.find(i => i.id === item.id);
            if (existing) {
                existing.quantity++;
            } else {
                state.cart.push({ ...item, quantity: 1 });
            }
        },
        CLEAR_CART(state) {
            state.cart = [];
        },
        SET_MENU_ITEMS(state, items) {
            state.menuItems = items;
        },
    },
    actions: {
        async login({ commit }, credentials) {
            const response = await api.login(credentials);
            if (response.data.success) {
                localStorage.setItem('token', response.data.data.token);
                commit('SET_USER', response.data.data.user);
            }
            return response.data;
        },
        async loadMenu({ commit }) {
            const response = await api.getMenuItems();
            commit('SET_MENU_ITEMS', response.data.data);
        },
        async placeOrder({ state, commit }, deliveryInfo) {
            const orderData = {
                items: state.cart.map(item => ({
                    menu_item_id: item.id,
                    quantity: item.quantity,
                })),
                ...deliveryInfo,
            };
            const response = await api.createOrder(orderData);
            if (response.data.success) {
                commit('CLEAR_CART');
            }
            return response.data;
        },
    },
});
```

---

## 📱 React Native Example

```javascript
import axios from 'axios';

const API_URL = 'http://YOUR_COMPUTER_IP:8000/api'; // Use your local IP

// Example: Get menu items
const getMenuItems = async () => {
    try {
        const response = await axios.get(`${API_URL}/menu-items`);
        return response.data.data;
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
};

// Example: Place order
const placeOrder = async (cartItems, deliveryInfo, token) => {
    try {
        const response = await axios.post(
            `${API_URL}/orders`,
            {
                items: cartItems,
                ...deliveryInfo,
            },
            {
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            }
        );
        return response.data;
    } catch (error) {
        console.error('Order error:', error);
        throw error;
    }
};
```

---

## 🔥 Common Patterns

### Error Handling
```javascript
try {
    const response = await fetch(url, options);
    const data = await response.json();
    
    if (!response.ok) {
        throw new Error(data.message || 'Request failed');
    }
    
    return data;
} catch (error) {
    console.error('API Error:', error);
    // Show user-friendly error message
}
```

### Loading States
```javascript
const [loading, setLoading] = useState(false);

const loadData = async () => {
    setLoading(true);
    try {
        const data = await api.getMenuItems();
        // Process data
    } finally {
        setLoading(false);
    }
};
```

### Authentication Check
```javascript
const isAuthenticated = () => {
    return !!localStorage.getItem('token');
};

// Protected route check
if (!isAuthenticated()) {
    navigate('/login');
}
```

---

## 🎯 Best Practices

1. **Store token securely** - Use httpOnly cookies for production
2. **Handle token expiration** - Refresh tokens or redirect to login
3. **Show loading states** - Better UX during API calls
4. **Handle errors gracefully** - Show user-friendly messages
5. **Validate input** - Before sending to API
6. **Use environment variables** - For API URL in production
7. **Implement retry logic** - For failed requests
8. **Cache data** - When appropriate to reduce API calls

---

Happy coding! 🚀
