<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../checkout.css">
    <title>Checkout - Payment Details</title>
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <section class="checkout-section container">
        <div class="checkout-wrapper">
            <!-- Left Side: Illustration -->
            <div class="checkout-left d-none d-lg-flex">
                <div class="checkout-illustration">
                    <img src="../images/checkout-pic.png" alt="Checkout Illustration">
                </div>
            </div>

            <!-- Right Side: Payment Form -->
            <div class="checkout-right">
                <div class="checkout-header">
                    <h2>Payment details</h2>
                    <a href="#" class="qr-code-link">
                        <i class="fas fa-qrcode"></i>
                        QR code
                    </a>
                </div>

                <!-- Express Payment -->
                <div class="payment-options">
                    <button class="payment-btn">
                        <i class="fab fa-google-pay" style="color: #EA4335; font-size: 40px;"></i>
                    </button>
                    <button class="payment-btn">
                        <i class="fab fa-apple-pay" style="color: #000; font-size: 40px;"></i>
                    </button>
                    <button class="payment-btn">
                        <i class="fab fa-paypal" style="color: #003087; font-size: 40px;"></i>
                    </button>
                </div>

                <div class="pay-separator">Or</div>

                <!-- Form -->
                <form class="checkout-form" id="checkout-form">
                    <div class="form-group">
                        <label>Delivery Address <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="text" id="address" placeholder="Enter your delivery neighborhood or address" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Phone Number <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="text" id="phone" placeholder="+237 ..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Special Notes (Optional)</label>
                        <div class="input-wrapper">
                            <textarea id="notes" class="form-control" placeholder="Any special instructions for the chef or driver?"></textarea>
                        </div>
                    </div>

                    <div class="total-display mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="subtotal-display">0 FCFA</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Delivery Fee:</span>
                            <span>1000 FCFA</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total Amount:</span>
                            <span class="amount">0 FCFA</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-pay mt-4">Place Order</button>
                    <p class="text-center mt-3 text-muted"><small>Payment will be Cash on Delivery</small></p>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="../js/config.js"></script>
    <script src="../js/auth.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/checkout-page.js"></script>
</body>

</html>
