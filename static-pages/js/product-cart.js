// Product Page Cart Handler
$(document).ready(function () {
    // Handle Add to Cart button clicks (only buttons, not links)
    $('button.product-btn').on('click', function (e) {
        e.preventDefault();

        const $card = $(this).closest('.product-card');
        const productName = $card.find('.product-name').text().trim();
        const productPrice = $card.find('.product-price').text().trim();
        const productImg = $card.find('.product-img').attr('src');

        // Generate a simple ID from the product name
        const productId = productName.toLowerCase().replace(/[^a-z0-9]/g, '-');

        // Create product object
        const product = {
            id: productId,
            name: productName,
            price: productPrice,
            image: productImg,
            category: 'Traditional Dish'
        };

        // Add to cart
        window.cartManager.addToCart(product);
    });
});
