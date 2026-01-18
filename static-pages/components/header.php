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
            <a href="../pages/about.php">About Us</a>
        </nav>
        <div class="header-right d-flex align-items-center">
            <div class="icons">
                <a href="../pages/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="../pages/register.php"><i class="fa-solid fa-user"></i></a>
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
    });
</script>