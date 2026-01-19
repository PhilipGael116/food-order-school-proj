<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../about.css">
    <title>About Us - Food</title>
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <!-- Hero Section -->
    <section class="about-hero d-flex align-items-center justify-content-center py-md-5 py-4" style="min-height: 350px;">
        <div class="hero-content text-white text-center position-relative z-2">
            <h1 class="fw-bold display-3 mb-3">About Food</h1>
            <p class="mx-auto fs-5" style="max-width: 600px;">Bringing authentic Cameroonian cuisine to your table with passion, tradition, and excellence</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section py-5" style="background: #ffffff;">
        <div class="container">
            <!-- Introduction -->
            <div class="about-header mb-5">
                <span class="section-badge d-inline-flex align-items-center gap-2 bg-light-tangerine text-tangerine px-3 py-2 rounded-pill fw-bold small mb-3">OUR STORY</span>
                <h2 class="fw-bold h1 mb-3">Welcome to <span class="highlight">Food</span></h2>
                <p class="text-secondary fs-6 lh-lg" style="max-width: 600px;">
                    We are dedicated to bringing the authentic flavors of Cameroon straight to your doorstep, 
                    prepared with love, tradition, and the finest ingredients available.
                </p>
            </div>

            <!-- Story Section -->
            <div class="row story-row align-items-center g-4 mb-5">
                <div class="col-lg-6">
                    <div class="story-content">
                        <h3 class="fw-bold h2 mb-4">Our <span class="highlight">Heritage</span></h3>
                        <p class="text-secondary lh-lg fs-6">
                            Founded by Chef Gael, a Cameroonian culinary expert with over 15 years of experience, 
                            Gael's Kitchen combines traditional recipes passed down through generations with modern 
                            dining convenience. We believe in the power of authentic food to connect people and celebrate culture.
                        </p>
                        <p class="text-secondary lh-lg fs-6 mt-3">
                            Every dish is prepared fresh daily using locally sourced ingredients, ensuring quality 
                            and authenticity in every bite. From the spicy flavors of Eru to the richness of Ndole, 
                            our menu tells the story of Cameroon.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-image">
                        <img src="../images/ndole.png" alt="Traditional Cameroonian Cuisine" class="w-100 h-100">
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="features-grid">
                <div class="feature-card card border-0 shadow-sm p-4 text-center">
                    <div class="feature-icon d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.2rem;">
                        <i class="fas fa-leaf text-white"></i>
                    </div>
                    <h4 class="fw-bold mb-3 fs-6">Fresh Ingredients</h4>
                    <p class="text-secondary fs-sm mb-0 lh-lg">We source only the finest local ingredients daily, ensuring authentic taste and nutritional value in every dish.</p>
                </div>

                <div class="feature-card card border-0 shadow-sm p-4 text-center">
                    <div class="feature-icon d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.2rem;">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h4 class="fw-bold mb-3 fs-6">Quality Assured</h4>
                    <p class="text-secondary fs-sm mb-0 lh-lg">Every meal is prepared with attention to detail and consistent quality standards to exceed your expectations.</p>
                </div>

                <div class="feature-card card border-0 shadow-sm p-4 text-center">
                    <div class="feature-icon d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.2rem;">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <h4 class="fw-bold mb-3 fs-6">Fast Delivery</h4>
                    <p class="text-secondary fs-sm mb-0 lh-lg">Hot, fresh meals delivered quickly to your door, ensuring you enjoy your food at its absolute best.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section py-5 bg-light">
        <div class="container">
            <div class="team-header text-center mb-5">
                <span class="section-badge d-inline-flex align-items-center gap-2 bg-white text-tangerine px-3 py-2 rounded-pill fw-bold small mb-3">OUR TEAM</span>
                <h2 class="fw-bold h1 mb-3">Meet Our Expert <span class="highlight">Team</span></h2>
                <p class="text-secondary fs-6 lh-lg" style="max-width: 600px; margin-left: auto; margin-right: auto;">
                    Dedicated professionals committed to delivering exceptional service and authentic culinary experiences.
                </p>
            </div>

            <div class="team-grid">
                <div class="team-member-card text-center">
                    <div class="member-image rounded-3 position-relative overflow-hidden mb-4">
                        <img src="../images/chef.png" alt="Chef Gael" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h4 class="fw-bold mb-2 fs-6">Chef Gael</h4>
                    <p class="text-secondary mb-3 small">Founder & Head Chef</p>
                    <div class="member-social d-flex align-items-center justify-content-center gap-2">
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 45px; height: 45px; background-color: var(--color-tangerine);">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-tangerine bg-light-tangerine">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="background-color: var(--color-tangerine);">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="team-member-card text-center">
                    <div class="member-image rounded-3 position-relative overflow-hidden mb-4">
                        <img src="../images/chef.png" alt="Marie Adjua" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h4 class="fw-bold mb-2 fs-6">Marie Adjua</h4>
                    <p class="text-secondary mb-3 small">Sous Chef</p>
                    <div class="member-social d-flex align-items-center justify-content-center gap-2">
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 45px; height: 45px; background-color: var(--color-tangerine);">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-tangerine bg-light-tangerine">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="background-color: var(--color-tangerine);">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="team-member-card text-center">
                    <div class="member-image rounded-3 position-relative overflow-hidden mb-4">
                        <img src="../images/chef.png" alt="Jean Pierre" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h4 class="fw-bold mb-2 fs-6">Jean Pierre</h4>
                    <p class="text-secondary mb-3 small">Pastry Chef</p>
                    <div class="member-social d-flex align-items-center justify-content-center gap-2">
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 45px; height: 45px; background-color: var(--color-tangerine);">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-tangerine bg-light-tangerine">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="background-color: var(--color-tangerine);">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="team-member-card text-center">
                    <div class="member-image rounded-3 position-relative overflow-hidden mb-4">
                        <img src="../images/chef.png" alt="Sarah Ekobo" class="w-100 h-100 object-fit-cover">
                    </div>
                    <h4 class="fw-bold mb-2 fs-6">Sarah Ekobo</h4>
                    <p class="text-secondary mb-3 small">Kitchen Manager</p>
                    <div class="member-social d-flex align-items-center justify-content-center gap-2">
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 45px; height: 45px; background-color: var(--color-tangerine);">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-tangerine bg-light-tangerine">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link d-flex align-items-center justify-content-center rounded-circle text-white" style="background-color: var(--color-tangerine);">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-white text-center py-5">
        <div class="cta-content mx-auto position-relative z-2" style="max-width: 700px;">
            <h2 class="fw-bold display-5 mb-3">Ready to Experience <span class="highlight">Authentic Flavors?</span></h2>
            <p class="fs-5 lh-lg mb-4">Join thousands of satisfied customers enjoying the best Cameroonian cuisine delivered to their door.</p>
            <a href="../pages/menu.php" class="cta-btn btn btn-light fw-bold px-5 py-2">
                <i class="fas fa-shopping-bag me-2"></i>
                Order Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // ============================================
            // SCROLL ANIMATIONS
            // ============================================
            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.bottom >= 0
                );
            }

            function triggerScrollAnimations() {
                $('.feature-card, .team-member-card, .story-content').each(function() {
                    if (isInViewport(this) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                    }
                });
            }

            // TEAM MEMBER CARDS HOVER EFFECTS
            $('.team-member-card').on('mouseenter', function() {
                $(this).find('.member-image-wrapper').stop().animate({
                    'margin-bottom': '35px'
                }, 300, 'easeOutQuad');
            }).on('mouseleave', function() {
                $(this).find('.member-image-wrapper').stop().animate({
                    'margin-bottom': '25px'
                }, 300, 'easeOutQuad');
            });
            // SMOOTH SCROLL NAVIGATION
            $('a[href*="#section"]').on('click', function(e) {
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 1000, 'easeInOutQuad');
                }
            });

            // SCROLL EVENT
            $(window).on('scroll', function() {
                triggerScrollAnimations();
            });

            // ============================================
            // INITIALIZE ON PAGE LOAD
            // ============================================
            triggerScrollAnimations();

            // Stagger animation delays for team members
            $('.team-member-card').each(function(index) {
                $(this).css('--animation-delay', (index * 0.1) + 's');
            });

            $('.feature-card').each(function(index) {
                $(this).css('--animation-delay', (index * 0.15) + 's');
            });

            // Button click animation
            $('.cta-btn').on('mousedown', function() {
                $(this).animate({
                    'padding': '13px 45px'
                }, 100);
            }).on('mouseup', function() {
                $(this).animate({
                    'padding': '15px 45px'
                }, 100);
            });
        });
    </script>

</body>

</html>