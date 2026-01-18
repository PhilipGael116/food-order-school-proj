// Checkout Page Handler
$(document).ready(function () {
    updateCheckoutTotal();

    function updateCheckoutTotal() {
        const subtotal = window.cartManager.getTotal();
        // Flat rate 1000 FCFA
        const shipping = subtotal > 0 ? 1000 : 0;
        const total = subtotal + shipping;

        $('.total-display .amount').text(`${total} FCFA`);
        $('.btn-pay').text(`Pay ${total} FCFA`);
    }
});
