<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../cart.css">
    <title>Shopping Cart</title>
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <section class="cart-section container">
        <div class="row">
            <!-- Left Side: Table -->
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product 1: Eru -->
                            <tr>
                                <td>
                                    <div class="cart-product-cell">
                                        <img src="../images/eru.png" alt="Eru" class="cart-product-img">
                                        <div class="cart-product-info">
                                            <span class="name">Special Eru & Water Fufu</span>
                                            <span class="meta">Traditional Dish</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-price">$24.00</span>
                                </td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="quantity-btn">-</button>
                                        <input type="text" class="quantity-value" value="1" readonly>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-subtotal">$24.00</span>
                                </td>
                            </tr>
                            <!-- Product 2: Ndole -->
                            <tr>
                                <td>
                                    <div class="cart-product-cell">
                                        <img src="../images/ndole.png" alt="Ndole" class="cart-product-img">
                                        <div class="cart-product-info">
                                            <span class="name">Creamy Ndole & Miondo</span>
                                            <span class="meta">Traditional Dish</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-price">$30.00</span>
                                </td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="quantity-btn">-</button>
                                        <input type="text" class="quantity-value" value="1" readonly>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-subtotal">$30.00</span>
                                </td>
                            </tr>
                            <!-- Product 3: Achu -->
                            <tr>
                                <td>
                                    <div class="cart-product-cell">
                                        <img src="../images/achu.png" alt="Achu" class="cart-product-img">
                                        <div class="cart-product-info">
                                            <span class="name">Achu & Yellow Soup</span>
                                            <span class="meta">Traditional Dish</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-price">$70.00</span>
                                </td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="quantity-btn">-</button>
                                        <input type="text" class="quantity-value" value="1" readonly>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                </td>
                                <td>
                                    <span class="cart-subtotal">$70.00</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="cart-actions">
                        <div class="coupon-box">
                            <input type="text" placeholder="Coupon code" class="coupon-input">
                            <button class="btn-apply">Apply coupon</button>
                        </div>
                        <button class="btn-remove-all">Remove All</button>
                    </div>
                </div>
            </div>

            <!-- Right Side: Totals -->
            <div class="col-lg-4">
                <div class="cart-totals-card">
                    <h4 class="totals-title">Cart totals</h4>
                    
                    <div class="totals-row">
                        <span>Subtotal</span>
                        <span class="fw-bold">$124.00</span>
                    </div>

                    <div class="totals-row shipping">
                        <div class="shipping-header">
                            <span>Shipping</span>
                        </div>
                        <div class="shipping-options">
                            <div class="shipping-opt">
                                <span>Flat rate: <span class="text-tangerine">$5.00</span></span>
                                <input type="radio" name="shipping" checked>
                            </div>
                            <div class="shipping-opt">
                                <span>Local pickup</span>
                                <input type="radio" name="shipping">
                            </div>
                            <div class="mt-2">
                                Shipping to <span class="fw-bold">Yaoundé, CM</span>
                            </div>
                            <a href="#" class="text-tangerine text-decoration-none small fw-bold mt-1 d-inline-block">Change address</a>
                        </div>
                    </div>

                    <div class="total-amount-row">
                        <span>Total</span>
                        <span class="text-tangerine">$129.00</span>
                    </div>

                    <a href="checkout.php" class="btn btn-checkout text-center d-block text-decoration-none">Proceed to checkout</a>
                </div>
            </div>
        </div>

        <!-- Subscription Banner -->
        <div class="newsletter-banner">
            <div class="newsletter-content">
                <h2 class="newsletter-title">Get update regularly and best offer subscribe us</h2>
                <div class="newsletter-input-group">
                    <input type="email" placeholder="Enter your email...">
                    <button class="btn-subscribe">SUBSCRIBE</button>
                </div>
            </div>
            <img src="../images/chef.png" alt="Chef" class="chef-img d-none d-lg-block">
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
