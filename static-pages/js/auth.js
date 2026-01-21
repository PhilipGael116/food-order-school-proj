// Auth Manager - Handles Login, Registration and Token Management
class AuthManager {
    constructor() {
        this.token = localStorage.getItem('auth_token');
        this.user = JSON.parse(localStorage.getItem('auth_user'));
    }

    // Register a new user
    async register(userData) {
        try {
            const response = await fetch(`${CONFIG.API_URL}/register`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(userData)
            });

            const data = await response.json();

            if (data.success) {
                this.saveSession(data.data.token, data.data.user);
                return { success: true, message: data.message };
            } else {
                return { success: false, errors: data.errors || data.message };
            }
        } catch (error) {
            console.error('Registration error:', error);
            return { success: false, message: 'Server error. Please try again later.' };
        }
    }

    // Login user
    async login(credentials) {
        try {
            const response = await fetch(`${CONFIG.API_URL}/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(credentials)
            });

            const data = await response.json();

            if (data.success) {
                this.saveSession(data.data.token, data.data.user);
                return { success: true, message: data.message };
            } else {
                return { success: false, message: data.message };
            }
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, message: 'Server error. Please try again later.' };
        }
    }

    // Logout user
    async logout() {
        if (this.token) {
            try {
                await fetch(`${CONFIG.API_URL}/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${this.token}`,
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.error('Logout error:', error);
            }
        }
        this.clearSession();
    }

    // Save token and user to localStorage
    saveSession(token, user) {
        this.token = token;
        this.user = user;
        localStorage.setItem('auth_token', token);
        localStorage.setItem('auth_user', JSON.stringify(user));
    }

    // Clear session
    clearSession() {
        this.token = null;
        this.user = null;
        localStorage.removeItem('auth_token');
        localStorage.removeItem('auth_user');
    }

    // Check if logged in
    isLoggedIn() {
        return !!this.token;
    }

    // Get current user
    getCurrentUser() {
        return this.user;
    }

    // Get auth headers
    getAuthHeaders() {
        return {
            'Authorization': `Bearer ${this.token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        };
    }
}

window.authManager = new AuthManager();
