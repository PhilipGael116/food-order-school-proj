// Checkout Page Logic
$(document).ready(function () {
    // 1. Check if user is authenticated
    if (!window.apiService.isAuthenticated()) {
        alert('Please login or register to complete your order.');
        window.location.href = 'register.php';
        return;
    }

    const user = window.apiService.getUser();
    const cart = window.cartManager.getCart();

    if (cart.length === 0) {
        alert('Your cart is empty!');
        window.location.href = 'menu.php';
        return;
    }

    // 2. Update the display total
    function updateCheckoutDisplay() {
        const subtotal = window.cartManager.getTotal();
        const shipping = 1000; // Flat rate
        const total = subtotal + shipping;

        $('.amount').text(`${total} FCFA`);
        $('.btn-pay').text(`Pay ${total} FCFA`);
    }

    updateCheckoutDisplay();

    // 3. Handle Payment Form Submission
    $('.checkout-form').on('submit', async function (e) {
        e.preventDefault();

        // Check if user has address/phone
        if (!user.address || !user.phone) {
            alert('Please update your profile with a delivery address and phone number.');
            return;
        }

        const btn = $('.btn-pay');
        btn.prop('disabled', true).text('Processing...');

        // Map cart items for backend
        const items = cart.map(item => ({
            slug: item.id, // Our frontend IDs are the slugs
            quantity: item.quantity
        }));

        // Prepare order data for backend
        const orderData = {
            delivery_address: user.address,
            delivery_phone: user.phone,
            payment_method: 'online',
            notes: 'Order from website frontend',
            items: items
        };

        const response = await window.apiService.placeOrder(orderData);

        if (response.success) {
            alert(`Order #${response.data.order_number} placed successfully! Thank you for ordering from Gael's Kitchen.`);
            window.cartManager.clearCart();
            window.location.href = 'home.php';
        } else {
            alert('Order failed: ' + (response.message || 'Unknown error'));
            btn.prop('disabled', false).text(`Pay ${window.cartManager.getTotal() + 1000} FCFA`);
        }
    });
});
