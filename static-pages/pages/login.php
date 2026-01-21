<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../register.css">
    <title>Login - Cameroonian Cuisine</title>
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <section class="register-section container">
        <div class="register-wrapper">
            <!-- Left Side: Form -->
            <div class="register-left">
                <h1>Welcome Back <br> Ready for more Flavor?</h1>
                
                <div class="subtitle">PLEASE LOGIN TO YOUR ACCOUNT</div>

                <form class="register-form" id="loginForm">
                    <div id="authAlert" class="alert d-none"></div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="loginEmail" placeholder="example@mail.com" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="loginPassword" placeholder="********" required>
                            <i class="far fa-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="form-utils">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="remember" class="me-2">
                            <label for="remember" class="m-0">Remember me</label>
                        </div>
                        <a href="#">Forgot Password</a>
                    </div>

                    <div class="register-btns text-center">
                        <button type="submit" class="btn-login" id="loginBtn">
                            <i class="fas fa-chevron-right"></i> Login
                        </button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <p>Don't have an account? <a href="register.php">Register here</a></p>
                    </div>
                </form>
            </div>

            <!-- Right Side: Hero Image -->
            <div class="register-right d-none d-lg-flex">
                <div class="shape-bg"></div>
                <img src="../images/register-hero.png" alt="Login Hero" class="register-hero-img">
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

    <script src="../js/config.js"></script>
    <script src="../js/auth.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Password toggle
            $('.password-toggle').on('click', function() {
                const input = $('#loginPassword');
                const type = input.attr('type') === 'password' ? 'text' : 'password';
                input.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });

            // Handle Login
            $('#loginForm').on('submit', async function(e) {
                e.preventDefault();
                
                const btn = $('#loginBtn');
                const alert = $('#authAlert');
                
                const credentials = {
                    email: $('#loginEmail').val(),
                    password: $('#loginPassword').val()
                };

                // Clear alerts
                alert.addClass('d-none').removeClass('alert-danger alert-success').text('');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Logging in...');

                try {
                    const result = await authManager.login(credentials);
                    
                    if (result.success) {
                        alert.removeClass('d-none').addClass('alert-success').text(result.message + ' Redirecting...');
                        setTimeout(() => {
                            window.location.href = 'home.php';
                        }, 2000);
                    } else {
                        btn.prop('disabled', false).html('<i class="fas fa-chevron-right"></i> Login');
                        alert.removeClass('d-none').addClass('alert-danger').text(result.message);
                    }
                } catch (error) {
                    btn.prop('disabled', false).html('<i class="fas fa-chevron-right"></i> Login');
                    alert.removeClass('d-none').addClass('alert-danger').text('Something went wrong. Please try again.');
                }
            });
        });
    </script>
</body>

</html>
