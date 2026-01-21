/**
 * API Service - Handles all communication with the Laravel Backend
 */
class APIService {
    constructor() {
        this.baseURL = 'http://localhost/food-order-school-proj/backend-simple/index.php';
        this.tokenKey = 'gaels_kitchen_token';
        this.userKey = 'gaels_kitchen_user';
    }

    // AUTHENTICATION (Unified Register/Login)
    async register(name, email, password) {
        try {
            const response = await fetch(`${this.baseURL}/register`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            const data = await response.json();
            if (data.success) {
                this.saveSession(data.data.token, data.data.user);
            }
            return data;
        } catch (error) {
            console.error('Auth error:', error);
            return { success: false, message: 'Server connection failed.' };
        }
    }

    async login(email, password) {
        try {
            const response = await fetch(`${this.baseURL}/login`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            const data = await response.json();
            if (data.success) {
                this.saveSession(data.data.token, data.data.user);
            }
            return data;
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, message: 'Server connection failed.' };
        }
    }

    logout() {
        // We call the backend logout if possible, but always clear local session
        const token = this.getToken();
        if (token) {
            fetch(`${this.baseURL}/logout`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            }).catch(e => console.warn('Backend logout failed, session cleared locally.'));
        }
        localStorage.removeItem(this.tokenKey);
        localStorage.removeItem(this.userKey);
        window.location.href = 'home.php';
    }

    // ORDERS
    async placeOrder(orderDetails) {
        const token = this.getToken();
        if (!token) return { success: false, message: 'You must be logged in to place an order.' };

        try {
            const response = await fetch(`${this.baseURL}/orders`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(orderDetails)
            });
            return await response.json();
        } catch (error) {
            console.error('Order error:', error);
            return { success: false, message: 'Server connection failed.' };
        }
    }

    // SESSION HELPERS
    saveSession(token, user) {
        localStorage.setItem(this.tokenKey, token);
        localStorage.setItem(this.userKey, JSON.stringify(user));
    }

    getToken() {
        return localStorage.getItem(this.tokenKey);
    }

    getUser() {
        const user = localStorage.getItem(this.userKey);
        return user ? JSON.parse(user) : null;
    }

    isAuthenticated() {
        return !!this.getToken();
    }
}

// Global instance
window.apiService = new APIService();
