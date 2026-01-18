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
                <form class="checkout-form">
                    <div class="form-group">
                        <label>Card Number <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="5678 **** **** 1267">
                            <i class="far fa-eye-slash input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Card Holder Name</label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="Cameron Williamson">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiry Date <span>*</span></label>
                            <div class="input-wrapper">
                                <input type="text" placeholder="mm / yy">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>CVV/CVV2 <span>*</span></label>
                            <div class="input-wrapper">
                                <input type="text" placeholder="xxx">
                                <div class="card-type-icon">
                                    <i class="fab fa-cc-mastercard text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="total-display">
                        <span>Total Amount:</span>
                        <span class="amount">$129</span>
                    </div>

                    <button type="submit" class="btn-pay">Pay $129</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/checkout-page.js"></script>
</body>

</html>
