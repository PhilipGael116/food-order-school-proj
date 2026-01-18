// Cart Page Handler
$(document).ready(function () {
    const $cartContainer = $('.cart-table-container');
    const $totalsCard = $('.cart-totals-card');

    renderCart();

    // Render cart items
    function renderCart() {
        const cart = window.cartManager.getCart();

        if (cart.length === 0) {
            // Show empty state for the entire table container
            $cartContainer.html(`
                <div class="text-center py-5">
                    <i class="fa fa-shopping-cart" style="font-size: 64px; color: #eee; margin-bottom: 20px;"></i>
                    <h3 class="fw-bold">Your cart is empty</h3>
                    <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                    <a href="menu.php" class="btn btn-primary mt-3 px-4 py-2" style="background: var(--color-tangerine); border: none; border-radius: 12px; font-weight: 700;">Start Ordering</a>
                </div>
            `);

            // Hide totals card on mobile or adjust it
            $totalsCard.css('opacity', '0.5');
            $totalsCard.find('.btn-checkout').addClass('disabled').attr('href', 'javascript:void(0)');

            updateTotals();
            return;
        }

        // Restore table structure if it was empty
        if (!$cartContainer.find('table').length) {
            $cartContainer.html(`
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="cart-actions">
                    <div class="coupon-box">
                        <input type="text" placeholder="Coupon code" class="coupon-input">
                        <button class="btn-apply">Apply coupon</button>
                    </div>
                    <button class="btn-remove-all">Remove All</button>
                </div>
            `);
        }

        const $tbody = $('.cart-table tbody');
        let html = '';
        cart.forEach(item => {
            const subtotal = item.price * item.quantity;
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
                        <span class="cart-price">${item.price} FCFA</span>
                    </td>
                    <td>
                        <div class="quantity-control">
                            <button class="quantity-btn decrease-qty" data-id="${item.id}">-</button>
                            <input type="text" class="quantity-value" value="${item.quantity}" readonly>
                            <button class="quantity-btn increase-qty" data-id="${item.id}">+</button>
                        </div>
                    </td>
                    <td>
                        <span class="cart-subtotal">${subtotal} FCFA</span>
                    </td>
                </tr>
            `;
        });

        $tbody.html(html);
        $totalsCard.css('opacity', '1');
        $totalsCard.find('.btn-checkout').removeClass('disabled').attr('href', 'checkout.php');

        updateTotals();
    }

    // Update totals
    function updateTotals() {
        const subtotal = window.cartManager.getTotal();

        // Get selected shipping cost
        const selectedShipping = $('input[name="shipping"]:checked').val();
        const shipping = subtotal > 0 ? parseFloat(selectedShipping || 0) : 0;

        const total = subtotal + shipping;

        $('.totals-row span:last-child').first().text(`${subtotal} FCFA`);
        $('.total-amount-row .text-tangerine').text(`${total} FCFA`);
    }

    // Handle quantity increase
    $(document).on('click', '.increase-qty', function () {
        const itemId = $(this).data('id');
        const cart = window.cartManager.getCart();
        const item = cart.find(i => i.id === itemId);

        if (item) {
            window.cartManager.updateQuantity(itemId, item.quantity + 1);
            renderCart();
        }
    });

    // Handle quantity decrease
    $(document).on('click', '.decrease-qty', function () {
        const itemId = $(this).data('id');
        const cart = window.cartManager.getCart();
        const item = cart.find(i => i.id === itemId);

        if (item) {
            if (item.quantity > 1) {
                window.cartManager.updateQuantity(itemId, item.quantity - 1);
            } else {
                if (confirm(`Remove ${item.name} from cart?`)) {
                    window.cartManager.removeFromCart(itemId);
                }
            }
            renderCart();
        }
    });

    // Handle remove all
    $(document).on('click', '.btn-remove-all', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to remove all items from your cart?')) {
            window.cartManager.clearCart();
            renderCart();
        }
    });

    // Handle shipping option change
    $(document).on('change', 'input[name="shipping"]', function () {
        updateTotals();
    });
});
