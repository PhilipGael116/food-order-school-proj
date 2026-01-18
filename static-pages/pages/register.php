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

                <form class="register-form">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="example@mail.com">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <input type="password" placeholder="********">
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
                        <button type="submit" class="btn-login">
                            <i class="fas fa-chevron-right"></i> Register
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
