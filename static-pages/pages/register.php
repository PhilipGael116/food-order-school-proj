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
                
                <div class="subtitle" id="auth-subtitle">PLEASE REGISTER TO CONTINUE</div>

                <form class="register-form" id="auth-form">
                    <div class="form-group" id="group-name">
                        <label>Full Name</label>
                        <input type="text" id="name" placeholder="John Doe" required>
                    </div>

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

                    <div class="form-group" id="group-phone">
                        <label>Phone Number</label>
                        <input type="tel" id="phone" placeholder="+237 ..." required>
                    </div>

                    <div class="form-group" id="group-address">
                        <label>Delivery Address</label>
                        <textarea id="address" placeholder="Neighborhood, City" rows="2" required></textarea>
                    </div>

                    <div class="register-btns text-center">
                        <button type="submit" class="btn-login" id="submit-btn">
                            <i class="fas fa-chevron-right"></i> <span id="btn-text">Register Now</span>
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p id="toggle-text">Already have an account? <a href="#" id="toggle-auth">Log In</a></p>
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
    <script src="../js/api-service.js"></script>
    <script>
        $(document).ready(function() {
            let isLogin = false;

            // Toggle Between Login and Register
            $('#toggle-auth').on('click', function(e) {
                e.preventDefault();
                isLogin = !isLogin;
                
                if (isLogin) {
                    $('#auth-subtitle').text('PLEASE LOGIN TO CONTINUE');
                    $('#group-name, #group-phone, #group-address').hide();
                    $('#btn-text').text('Log In');
                    $('#toggle-text').html('Don\'t have an account? <a href="#" id="toggle-auth">Register Now</a>');
                } else {
                    $('#auth-subtitle').text('PLEASE REGISTER TO CONTINUE');
                    $('#group-name, #group-phone, #group-address').show();
                    $('#btn-text').text('Register Now');
                    $('#toggle-text').html('Already have an account? <a href="#" id="toggle-auth">Log In</a>');
                }
            });

            // Handle Form Submission
            $('#auth-form').on('submit', async function(e) {
                e.preventDefault();
                const btn = $('#submit-btn');
                btn.prop('disabled', true).css('opacity', '0.7');

                const email = $('#email').val();
                const password = $('#password').val();

                if (isLogin) {
                    const res = await window.apiService.login(email, password);
                    if (res.success) {
                        alert('Login successful!');
                        window.location.href = 'home.php';
                    } else {
                        alert(res.message || 'Login failed. Please check your credentials.');
                    }
                } else {
                    const name = $('#name').val();
                    const phone = $('#phone').val();
                    const address = $('#address').val();
                    
                    const res = await window.apiService.register(name, email, password, phone, address);
                    if (res.success) {
                        alert('Registration successful!');
                        window.location.href = 'home.php';
                    } else {
                        const errorMsg = res.errors ? Object.values(res.errors).flat().join('\n') : res.message;
                        alert('Registration failed:\n' + errorMsg);
                    }
                }
                btn.prop('disabled', false).css('opacity', '1');
            });
        });
    </script>
</body>

</html>
