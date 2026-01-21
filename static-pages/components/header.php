<header class="main-header">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <div class="logo">
            <a href="../pages/home.php">
                <img src="../images/logo.png" alt="logo" width="120">
            </a>
        </div>
        <nav class="nav d-none d-lg-block">
            <a href="../pages/home.php">Home</a>
            <a href="../pages/menu.php">Menu</a>
            <a href="../pages/about.php">About</a>
        </nav>
        <div class="header-right d-flex align-items-center">
            <div class="icons">
                <a href="../pages/cart.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-badge">0</span>
                </a>
                <div id="user-nav" class="d-inline-block ms-3">
                    <!-- Dynamic Auth Content -->
                    <a href="../pages/register.php" id="login-link"><i class="fa-solid fa-user"></i></a>
                </div>
            </div>
            <button class="hamburger-menu d-lg-none ms-3" id="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div class="mobile-nav" id="mobile-nav">
        <div class="mobile-nav-header d-flex justify-content-between align-items-center p-4">
            <img src="../images/logo.png" alt="logo" width="100">
            <button class="close-menu" id="close-menu"><i class="fas fa-times"></i></button>
        </div>
        <div class="mobile-nav-links p-4">
            <a href="../pages/home.php">Home</a>
            <a href="../pages/menu.php">Menu</a>
            <a href="../pages/about.php">About Us</a>
            <div class="mobile-social mt-5">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="mobile-overlay" id="mobile-overlay"></div>
</header>

<script src="../js/config.js"></script>
<script src="../js/auth.js"></script>
<script src="../js/cart-manager.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        const $mobileNav = $('#mobile-nav');
        const $overlay = $('#mobile-overlay');

        $('#mobile-menu-toggle').on('click', function() {
            $mobileNav.addClass('active');
            $overlay.addClass('active');
            $('body').css('overflow', 'hidden');
        });

        const closeHandler = () => {
            $mobileNav.removeClass('active');
            $overlay.removeClass('active');
            $('body').css('overflow', 'auto');
        };

        $('#close-menu, #mobile-overlay').on('click', closeHandler);

        // Update auth state in header
        function updateAuthState() {
            const user = authManager.getCurrentUser();
            const $userNav = $('#user-nav');
            const $mobileLinks = $('.mobile-nav-links');

            if (authManager.isLoggedIn() && user) {
                $userNav.html(`
                    <div class="dropdown d-inline">
                        <a href="#" class="dropdown-toggle text-dark text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user me-1 text-primary"></i> ${user.name.split(' ')[0]}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item py-2" href="#"><i class="fas fa-id-card me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="fas fa-shopping-bag me-2"></i> My Orders</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2 text-danger" href="#" id="logout-btn"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                `);

                // Update mobile nav with logout
                if ($mobileLinks.find('#mobile-logout').length === 0) {
                    $mobileLinks.append('<a href="#" id="mobile-logout" class="text-danger mt-3 d-block pe-auto">Logout</a>');
                }
            }

            // Logout handlers
            $(document).on('click', '#logout-btn, #mobile-logout', function(e) {
                e.preventDefault();
                authManager.logout();
                window.location.reload();
            });
        }

        updateAuthState();

        // Update cart badge on page load
        cartManager.updateCartBadge();
    });
</script>