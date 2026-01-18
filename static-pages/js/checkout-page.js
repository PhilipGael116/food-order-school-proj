// Checkout Page Handler
$(document).ready(function () {
    updateCheckoutTotal();

    function updateCheckoutTotal() {
        const subtotal = window.cartManager.getTotal();
        // For checkout, we'll assume flat rate $5 if they reached here, 
        // or we could store the choice. For now let's just make it dynamic based on cart.
        const shipping = subtotal > 0 ? 5.00 : 0;
        const total = subtotal + shipping;

        $('.total-display .amount').text(`$${total.toFixed(2)}`);
        $('.btn-pay').text(`Pay $${total.toFixed(2)}`);
    }
});
