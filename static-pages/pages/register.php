<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../register.css">
    <title>Register - Cameroonian Cuisine</title>
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <section class="register-section container">
        <div class="register-wrapper">
            <!-- Left Side: Form -->
            <div class="register-left">
                <h1>Order Your First Food <br> Get 50% Cash Back</h1>
                
                <div class="subtitle">PLEASE REGISTER TO CONTINUE</div>

                <form class="register-form" id="auth-form">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" placeholder="example@mail.com" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" placeholder="********" required>
                        </div>
                    </div>

                    <div class="register-btns text-center">
                        <button type="submit" class="btn-login" id="submit-btn">
                            <i class="fas fa-chevron-right"></i> Register Now
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side: Hero Image -->
            <div class="register-right d-none d-lg-flex">
                <div class="shape-bg"></div>
                <img src="../images/register-hero.png" alt="Registration Hero" class="register-hero-img">
                <div class="hero-curved-text">
                    <svg viewBox="0 0 700 250" xmlns="http://www.w3.org/2000/svg">
                        <path id="curve" d="M 50,220 Q 350,20 650,220" fill="transparent" stroke="none" />
                        <text width="700">
                            <textPath xlink:href="#curve" href="#curve" startOffset="50%" text-anchor="middle">
                                A TASTE BEYOND YOUR IMAGINATION
                            </textPath>
                        </text>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle Unified Authentication (Register/Login)
            $('#auth-form').on('submit', async function(e) {
                e.preventDefault();
                const btn = $('#submit-btn');
                const btnText = btn.html();
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

                const email = $('#email').val();
                const password = $('#password').val();

                // We only use the register endpoint now, as it handles both
                const res = await window.apiService.register(null, email, password);
                
                if (res.success) {
                    alert(res.message || 'Authenticated successfully!');
                    window.location.href = 'home.php';
                } else {
                    const errorMsg = res.errors ? Object.values(res.errors).flat().join('\n') : res.message;
                    alert('Authentication failed:\n' + errorMsg);
                }
                
                btn.prop('disabled', false).html(btnText);
            });
        });
    </script>
</body>

</html>
