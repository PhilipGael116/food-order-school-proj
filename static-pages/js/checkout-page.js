// Checkout Page Handler
$(document).ready(function () {
    // Check if user is logged in
    if (!authManager.isLoggedIn()) {
        alert('Please login or register to complete your order.');
        window.location.href = 'register.php';
        return;
    }

    updateCheckoutTotal();

    function updateCheckoutTotal() {
        const subtotal = window.cartManager.getTotal();
        // Flat rate 1000 FCFA
        const shipping = subtotal > 0 ? 1000 : 0;
        const total = subtotal + shipping;

        $('#subtotal-display').text(`${subtotal} FCFA`);
        $('.total-display .amount').text(`${total} FCFA`);
        $('.btn-pay').text(`Place Order (${total} FCFA)`);
    }

    // Handle form submission
    $('#checkout-form').on('submit', async function (e) {
        e.preventDefault();

        const cart = cartManager.getCart();
        if (cart.length === 0) {
            alert('Your cart is empty.');
            return;
        }

        const btn = $('.btn-pay');
        const originalText = btn.text();
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

        try {
            // 1. Sync cart to backend
            // Clear backend cart first
            await fetch(`${CONFIG.API_URL}/cart/clear`, {
                method: 'POST',
                headers: authManager.getAuthHeaders()
            });

            // Add each item to backend cart
            for (const item of cart) {
                await fetch(`${CONFIG.API_URL}/cart/add`, {
                    method: 'POST',
                    headers: authManager.getAuthHeaders(),
                    body: JSON.stringify({
                        menu_item_id: item.id,
                        quantity: item.quantity
                    })
                });
            }

            // 2. Place order
            const orderData = {
                delivery_address: $('#address').val() || 'No address provided', // Need to check if there's an address field
                delivery_phone: $('#phone').val() || '000000000',
                payment_method: 'cash', // Default for now
                notes: $('#notes').val() || ''
            };

            const response = await fetch(`${CONFIG.API_URL}/orders`, {
                method: 'POST',
                headers: authManager.getAuthHeaders(),
                body: JSON.stringify(orderData)
            });

            const data = await response.json();

            if (data.success) {
                alert('Order placed successfully!');
                cartManager.clearCart();
                window.location.href = 'home.php'; // Or a success page
            } else {
                alert('Failed to place order: ' + (data.message || 'Unknown error'));
                btn.prop('disabled', false).text(originalText);
            }
        } catch (error) {
            console.error('Checkout error:', error);
            alert('Something went wrong. Please try again.');
            btn.prop('disabled', false).text(originalText);
        }
    });
});
