// Cart Page Handler
$(document).ready(function () {
    renderCart();

    // Render cart items
    function renderCart() {
        const cart = cartManager.getCart();
        const $tbody = $('.cart-table tbody');

        if (cart.length === 0) {
            $tbody.html(`
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <i class="fa fa-shopping-cart" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                        <p class="text-muted">Your cart is empty</p>
                        <a href="menu.php" class="btn btn-primary mt-3">Browse Menu</a>
                    </td>
                </tr>
            `);
            updateTotals();
            return;
        }

        let html = '';
        cart.forEach(item => {
            const subtotal = (item.price * item.quantity).toFixed(2);
            html += `
                <tr data-item-id="${item.id}">
                    <td>
                        <div class="cart-product-cell">
                            <img src="${item.image}" alt="${item.name}" class="cart-product-img">
                            <div class="cart-product-info">
                                <span class="name">${item.name}</span>
                                <span class="meta">${item.category}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="cart-price">$${item.price.toFixed(2)}</span>
                    </td>
                    <td>
                        <div class="quantity-control">
                            <button class="quantity-btn decrease-qty" data-id="${item.id}">-</button>
                            <input type="text" class="quantity-value" value="${item.quantity}" readonly>
                            <button class="quantity-btn increase-qty" data-id="${item.id}">+</button>
                        </div>
                    </td>
                    <td>
                        <span class="cart-subtotal">$${subtotal}</span>
                    </td>
                </tr>
            `;
        });

        $tbody.html(html);
        updateTotals();
    }

    // Update totals
    function updateTotals() {
        const cart = cartManager.getCart();
        const subtotal = cartManager.getTotal();
        const shipping = 5.00;
        const total = subtotal + shipping;

        $('.totals-row span:last-child').first().text(`$${subtotal.toFixed(2)}`);
        $('.total-amount-row .text-tangerine').text(`$${total.toFixed(2)}`);
    }

    // Handle quantity increase
    $(document).on('click', '.increase-qty', function () {
        const itemId = $(this).data('id');
        const cart = cartManager.getCart();
        const item = cart.find(i => i.id === itemId);

        if (item) {
            cartManager.updateQuantity(itemId, item.quantity + 1);
            renderCart();
        }
    });

    // Handle quantity decrease
    $(document).on('click', '.decrease-qty', function () {
        const itemId = $(this).data('id');
        const cart = cartManager.getCart();
        const item = cart.find(i => i.id === itemId);

        if (item) {
            if (item.quantity > 1) {
                cartManager.updateQuantity(itemId, item.quantity - 1);
            } else {
                if (confirm(`Remove ${item.name} from cart?`)) {
                    cartManager.removeFromCart(itemId);
                }
            }
            renderCart();
        }
    });

    // Handle remove all
    $('.btn-remove-all').on('click', function () {
        if (confirm('Are you sure you want to remove all items from your cart?')) {
            cartManager.clearCart();
            renderCart();
        }
    });

    // Handle shipping option change
    $('input[name="shipping"]').on('change', function () {
        updateTotals();
    });
});
