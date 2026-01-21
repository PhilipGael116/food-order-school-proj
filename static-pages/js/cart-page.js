// Cart Page Logic
$(document).ready(function () {
    function renderCart() {
        const cart = window.cartManager.getCart();
        const $tbody = $('.cart-table tbody');
        $tbody.empty();

        if (cart.length === 0) {
            $tbody.append('<tr><td colspan="4" class="text-center py-5">Your cart is empty. <a href="menu.php" class="text-tangerine">Go to Menu</a></td></tr>');
            updateCartTotals();
            return;
        }

        cart.forEach(item => {
            const row = `
                <tr data-id="${item.id}">
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
                        <div class="quantity-control" data-id="${item.id}">
                            <button class="quantity-btn minus">-</button>
                            <input type="text" class="quantity-value" value="${item.quantity}" readonly>
                            <button class="quantity-btn plus">+</button>
                        </div>
                    </td>
                    <td>
                        <span class="cart-subtotal">${item.price * item.quantity} FCFA</span>
                    </td>
                </tr>
            `;
            $tbody.append(row);
        });

        updateCartTotals();
    }

    function updateCartTotals() {
        const subtotal = window.cartManager.getTotal();
        const shipping = parseInt($('input[name="shipping"]:checked').val()) || 0;
        const total = subtotal + shipping;

        $('.totals-row:first .fw-bold').text(`${subtotal} FCFA`);
        $('.total-amount-row .text-tangerine').text(`${total} FCFA`);
    }

    // Quantity controls
    $(document).on('click', '.quantity-btn', function () {
        const id = $(this).parent().data('id');
        const isPlus = $(this).hasClass('plus');
        const $input = $(this).siblings('.quantity-value');
        let val = parseInt($input.val());

        if (isPlus) {
            val++;
        } else {
            val = Math.max(0, val - 1);
        }

        window.cartManager.updateQuantity(id, val);
        renderCart();
    });

    // Remove All
    $('.btn-remove-all').on('click', function () {
        if (confirm('Clear entire cart?')) {
            window.cartManager.clearCart();
            renderCart();
        }
    });

    // Shipping change
    $('input[name="shipping"]').on('change', function () {
        updateCartTotals();
    });

    // Initial render
    renderCart();
});
