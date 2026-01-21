// Cart Page Logic
$(document).ready(function () {
    function renderCart() {
        const cart = window.cartManager.getCart();
        const $tbody = $('.cart-table tbody');
        const $cartRow = $('.cart-section .row');

        // Remove any existing empty state to avoid duplicates
        $('.empty-cart-state').remove();

        if (cart.length === 0) {
            // Hide the table and totals columns
            $cartRow.children().hide();

            // Inject the Empty State UI
            const emptyHtml = `
                <div class="col-12 text-center empty-cart-state py-5">
                    <div class="bg-white p-5 rounded-4 shadow-sm" style="max-width: 600px; margin: 0 auto;">
                        <i class="fas fa-shopping-basket mb-4" style="font-size: 80px; color: #fde8d0;"></i>
                        <h2 class="fw-bold mb-3">Your Cart is Empty</h2>
                        <p class="text-muted mb-4">Looks like you haven't made your choice yet. Go ahead and explore our delicious menu!</p>
                        <a href="menu.php" class="btn text-white fw-bold px-5 py-3" style="background-color: #f9942a; border-radius: 12px; transition: 0.3s;">
                            Return to Menu
                        </a>
                    </div>
                </div>
            `;
            $cartRow.append(emptyHtml);
            return;
        }

        // Show columns and clean up if cart has items
        $cartRow.children().not('.empty-cart-state').fadeIn();
        $tbody.empty();

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
