// Cart Manager - Handles all cart operations using localStorage
class CartManager {
    constructor() {
        this.cart = this.loadCart();
    }

    // Load cart from localStorage
    loadCart() {
        const cartData = localStorage.getItem('cameroonian_cart');
        return cartData ? JSON.parse(cartData) : [];
    }

    // Save cart to localStorage
    saveCart() {
        localStorage.setItem('cameroonian_cart', JSON.stringify(this.cart));
        this.updateCartBadge();
    }

    // Add item to cart
    addToCart(item) {
        const existingItem = this.cart.find(cartItem => cartItem.id === item.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.cart.push({
                id: item.id,
                name: item.name,
                price: parseFloat(item.price),
                image: item.image,
                quantity: 1,
                category: item.category || 'Traditional Dish'
            });
        }
        
        this.saveCart();
        this.showNotification(`${item.name} added to cart!`);
    }

    // Update item quantity
    updateQuantity(itemId, newQuantity) {
        const item = this.cart.find(cartItem => cartItem.id === itemId);
        
        if (item) {
            if (newQuantity <= 0) {
                this.removeFromCart(itemId);
            } else {
                item.quantity = newQuantity;
                this.saveCart();
            }
        }
    }

    // Remove item from cart
    removeFromCart(itemId) {
        this.cart = this.cart.filter(item => item.id !== itemId);
        this.saveCart();
    }

    // Clear entire cart
    clearCart() {
        this.cart = [];
        this.saveCart();
    }

    // Get cart items
    getCart() {
        return this.cart;
    }

    // Get cart total
    getTotal() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    // Get cart item count
    getItemCount() {
        return this.cart.reduce((count, item) => count + item.quantity, 0);
    }

    // Update cart badge in header
    updateCartBadge() {
        const badge = document.querySelector('.cart-badge');
        const count = this.getItemCount();
        
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    }

    // Show notification
    showNotification(message) {
        // Remove existing notification if any
        const existingNotif = document.querySelector('.cart-notification');
        if (existingNotif) {
            existingNotif.remove();
        }

        // Create notification
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.innerHTML = `
            <i class="fa fa-check-circle"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(notification);

        // Show notification
        setTimeout(() => notification.classList.add('show'), 10);

        // Hide and remove notification
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
}

// Initialize cart manager
const cartManager = new CartManager();
