<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../index.css">
    <title>Home</title>
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <section class="hero-section container mt-0 position-relative">
        <!-- Decorative Line -->
        <div class="hero-decoration d-none d-lg-block">
            <svg width="400" height="200" viewBox="0 0 514 249" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.5 187C50.5 212.5 120 220 160 170C200 120 150 50 100 80C50 110 80 180 150 180C250 180 350 100 500 20" stroke="#e0e0e0" stroke-width="3" stroke-dasharray="10 10"/>
                <path d="M485 15L510 5L505 35L485 15Z" fill="#e0e0e0"/>
            </svg>
        </div>
        <div class="row align-items-center">
            <!-- Left Side: Content -->
            <div class="col-lg-6">
                <div class="delivery-badge d-inline-flex align-items-center mb-4">
                    <span>Bike Delivery</span>
                    <div class="badge-icon ms-2">
                        <img src="../images/delivery-icon.png" alt="delivery" width="24">
                    </div>
                </div>
                <h1 class="hero-title mb-4">
                    The Fastest <br>
                    <span class="text-black">Delivery</span> In <br>
                    <span class="text-tangerine">Your City</span>
                </h1>
                <p class="hero-desc mb-5">
                    Experience the authentic taste of Cameroon delivered straight to your doorstep. From the spicy flavors of Eru to the richness of Ndole, we bring our heritage to your table.
                </p>
                <div class="hero-btns d-flex align-items-center">
                    <button class="btn btn-order-now me-4">Order Now</button>
                    <button class="btn btn-order-process d-flex align-items-center">
                        <div class="play-icon me-2">
                            <i class="fas fa-play"></i>
                        </div>
                        Order Process
                    </button>
                </div>
            </div>

            <!-- Right Side: Meal Grid -->
            <div class="col-lg-6 position-relative">
                <div class="meal-grid-bg"></div>
                <div class="row g-4 meal-cards">
                    <div class="col-6 mt-0">
                        <div class="meal-card">
                            <img src="../images/jollof.png" alt="Jollof Rice" class="meal-img">
                            <h4 class="meal-name mb-1">Jollof Rice</h4>
                            <p class="meal-desc mb-2">With Fried Plantain</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="meal-price">2500 <span>FCFA</span></span>
                                <div class="meal-nav">
                                    <i class="fas fa-arrow-left"></i>
                                    <i class="fas fa-arrow-right active"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="meal-card">
                            <img src="../images/eru.png" alt="Eru" class="meal-img">
                            <h4 class="meal-name mb-1">Eru</h4>
                            <p class="meal-desc mb-2">With Water Fufu</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="meal-price">4500 <span>FCFA</span></span>
                                <div class="meal-nav">
                                    <i class="fas fa-arrow-left"></i>
                                    <i class="fas fa-arrow-right active"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-0">
                        <div class="meal-card">
                            <img src="../images/ndole.png" alt="Ndole" class="meal-img">
                            <h4 class="meal-name mb-1">Ndole</h4>
                            <p class="meal-desc mb-2">With Miondo</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="meal-price">3500 <span>FCFA</span></span>
                                <div class="meal-nav">
                                    <i class="fas fa-arrow-left"></i>
                                    <i class="fas fa-arrow-right active"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="meal-card">
                            <img src="../images/achu.png" alt="Achu" class="meal-img">
                            <h4 class="meal-name mb-1">Achu</h4>
                            <p class="meal-desc mb-2">With Yellow Soup</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="meal-price">3000 <span>FCFA</span></span>
                                <div class="meal-nav">
                                    <i class="fas fa-arrow-left"></i>
                                    <i class="fas fa-arrow-right active"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container schedule mt-5">
        <div class="row g-4">
            <div class="col-sm-4">
                <div class="schedule-card border-end">
                    <i class="fas fa-clock mb-3"></i>
                    <p class="p1 fw-bold">Opening Hours</p>
                    <p class="p2">Mon - Sat: 8:00 AM - 10:00 PM</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="schedule-card border-end">
                    <i class="fas fa-map-marker-alt mb-3"></i>
                    <p class="p1 fw-bold">Our Location</p>
                    <p class="p2">Bastos, Yaoundé, Cameroon</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="schedule-card">
                    <i class="fas fa-phone-alt mb-3"></i>
                    <p class="p1 fw-bold">Contact Us</p>
                    <p class="p2">+237 670 123 456</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <div class="container text-center mt-5 mb-5">
        <h4 class="fw-bold mb-4 product-title">Our Products</h4>
        <div class="row row-cols-1 row-cols-md-3 g-5" id="featured-products-container">
            <!-- Products will be loaded here dynamically -->
            <div class="col-12 text-center py-5">
                <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                <p>Loading our delicious meals...</p>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="./menu.php" class="product-btn">See More Products <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <!-- How it works Section -->
    <section class="how-it-works container text-center" id="how-it-works">
        <div class="subtitle text-tangerine mb-2">How to work</div>
        <h2 class="title mb-5">Food Us An Important Part Of A Balanced Diet</h2>
        
        <div class="row g-5 align-items-center mt-2">
            <!-- Step 1: Choose -->
            <div class="col-lg-4">
                <div class="how-step">
                    <div class="how-step-image-wrapper">
                        <div class="laptop-container">
                            <img src="../images/laptop.png" alt="Laptop" class="laptop-img">
                        </div>
                    </div>
                    <div class="step-label">
                        CHOOSE <span class="step-dot ms-2"></span>
                    </div>
                    <p>Select your favorite Cameroonian meal from our diverse menu. We have everything from Jollof to Eru.</p>
                </div>
            </div>

            <!-- Step 2: Prepare -->
            <div class="col-lg-4">
                <div class="how-step">
                    <div class="how-step-image-wrapper">
                        <img src="../images/eru.png" alt="Prepared Food" class="deliver-img">
                    </div>
                    <div class="step-label justify-content-center">
                        <span class="step-dot me-2"></span> PREPARE FOOD <span class="step-dot ms-2"></span>
                    </div>
                    <p class="mx-auto text-center">Our professional chefs prepare your meal with the freshest ingredients and authentic spices.</p>
                </div>
            </div>

            <!-- Step 3: Deliver -->
            <div class="col-lg-4">
                <div class="how-step text-end">
                    <div class="how-step-image-wrapper">
                        <img src="../images/deliver-bags.png" alt="Deliver Bag" class="deliver-bag-img">
                    </div>
                    <div class="step-label justify-content-end">
                        <span class="step-dot me-2"></span> DELIVER
                    </div>
                    <p class="ms-auto text-end">Our bike delivery team ensures your food arrives hot and fresh in your city.</p>
                </div>
            </div>
        </div>

        <!-- Decorative Lines SVG -->
        <div class="how-decoration-lines d-none d-lg-block">
            <svg width="100%" height="200" viewBox="0 0 1000 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M150 100 C 250 150, 400 50, 500 100 S 750 150, 850 100" stroke="#f9942a" stroke-width="3" stroke-dasharray="10 10" opacity="0.6"/>
                <!-- Arrow Head -->
                <path d="M840 90 L860 100 L840 110 Z" fill="#f9942a" opacity="0.6"/>
            </svg>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section container">
        <div class="text-center mb-5">
            <div class="subtitle text-tangerine mb-2">Testimonials</div>
            <h2 class="title text-black">Our Happy Client Says</h2>
        </div>

        <div class="row align-items-center">
            <!-- Left Side: Carousel -->
            <div class="col-lg-6">
                <div id="testimonialCarousel" class="carousel slide testimonial-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="testimonial-card">
                                <div class="testimonial-user">
                                    <img src="../images/avatar-1.png" alt="Jean-Pierre" class="testimonial-avatar">
                                    <div class="testimonial-user-info">
                                        <div class="name">Jean-Pierre Nzeke</div>
                                        <div class="role">Software Engineer</div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    "The flavors are exactly like home! The Eru is perfectly seasoned, and the delivery was incredibly fast. Best Cameroonian food in the city by far."
                                </p>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <div class="testimonial-card">
                                <div class="testimonial-user">
                                    <img src="../images/avatar-2.png" alt="Maryam" class="testimonial-avatar">
                                    <div class="testimonial-user-info">
                                        <div class="name">Maryam Bako</div>
                                        <div class="role">Marketing Specialist</div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    "I order from here at least twice a week. The Ndole is so creamy and the portions are very generous. Highly recommended for anyone craving authentic taste!"
                                </p>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <div class="testimonial-card">
                                <div class="testimonial-user">
                                    <img src="../images/avatar-3.png" alt="Samuel" class="testimonial-avatar">
                                    <div class="testimonial-user-info">
                                        <div class="name">Samuel Nfor</div>
                                        <div class="role">Graphic Designer</div>
                                    </div>
                                </div>
                                <p class="testimonial-text">
                                    "Beautiful presentation and even better taste. The mobile app makes it so easy to order. I love the smoky flavor of their Jollof rice!"
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Right Side: Food Image -->
            <div class="col-lg-6 testimonial-food-img-container">
                <img src="../images/testimonial-platter.png" alt="Food Platter" class="testimonial-food-img">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/product-cart.js"></script>
    <script src="../js/product-loader.js"></script>
    <script>
        $(document).ready(async function() {
            // Load featured products
            const featuredProducts = await productLoader.fetchFeaturedProducts();
            productLoader.renderProducts(featuredProducts, 'featured-products-container');

            // Handle Add to Cart using event delegation for dynamic elements
            $(document).on('click', '.product-btn[data-id]', function() {
                const btn = $(this);
                const item = {
                    id: btn.data('id'),
                    name: btn.data('name'),
                    price: btn.data('price'),
                    image: btn.data('image'),
                    quantity: 1
                };
                
                cartManager.addToCart(item);
                
                // Visual feedback
                const originalContent = btn.html();
                btn.html('Added! <i class="fas fa-check"></i>').addClass('btn-success text-white').prop('disabled', true);
                setTimeout(() => {
                    btn.html(originalContent).removeClass('btn-success text-white').prop('disabled', false);
                }, 1500);
            });
        });
    </script>
</body>

</html>