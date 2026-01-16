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
                                <span class="meal-price">$5.15</span>
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
                                <span class="meal-price">$9.15</span>
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
                                <span class="meal-price">$6.15</span>
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
                                <span class="meal-price">$5.15</span>
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
        <div class="row row-cols-1 row-cols-md-3 g-5">
            <!-- Jollof -->
            <div class="col">
                <div class="product-card">
                    <img src="../images/jollof.png" alt="Jollof Rice" class="product-img">
                    <div class="product-name">Jollof Rice</div>
                    <p class="product-desc">Authentic smoky flavor with fried plantain.</p>
                    <div class="product-price">5.15</div>
                    <div class="product-footer">
                        <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>    
                        <div class="product-rating"><i class="fa fa-star"></i> 4.5</div>
                    </div>
                </div>
            </div>
            <!-- Eru -->
            <div class="col">
                <div class="product-card">
                    <img src="../images/eru.png" alt="Eru" class="product-img">
                    <div class="product-name">Eru & Water Fufu</div>
                    <p class="product-desc">Rich traditional vegetables with fufu.</p>
                    <div class="product-price">9.15</div>
                    <div class="product-footer">
                        <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>    
                        <div class="product-rating"><i class="fa fa-star"></i> 4.8</div>
                    </div>
                </div>
            </div>
            <!-- Ndole -->
            <div class="col">
                <div class="product-card">
                    <img src="../images/ndole.png" alt="Ndole" class="product-img">
                    <div class="product-name">Ndole & Miondo</div>
                    <p class="product-desc">Creamy bitter leaves with cassava.</p>
                    <div class="product-price">6.15</div>
                    <div class="product-footer">
                        <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>    
                        <div class="product-rating"><i class="fa fa-star"></i> 4.7</div>
                    </div>
                </div>
            </div>
            <!-- Achu -->
            <div class="col">
                <div class="product-card">
                    <img src="../images/achu.png" alt="Achu" class="product-img">
                    <div class="product-name">Achu & Yellow Soup</div>
                    <p class="product-desc">Taro paste with savory yellow soup.</p>
                    <div class="product-price">5.15</div>
                    <div class="product-footer">
                        <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>    
                        <div class="product-rating"><i class="fa fa-star"></i> 4.9</div>
                    </div>
                </div>
            </div>
            <!-- Repeat Jollof -->
            <div class="col">
                <div class="product-card">
                    <img src="../images/jollof.png" alt="Jollof Rice" class="product-img">
                    <div class="product-name">Jollof Delight</div>
                    <p class="product-desc">Extra spicy with choice of fish or chicken.</p>
                    <div class="product-price">7.50</div>
                    <div class="product-footer">
                        <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>    
                        <div class="product-rating"><i class="fa fa-star"></i> 4.6</div>
                    </div>
                </div>
            </div>
            <!-- Repeat Eru -->
            <div class="col">
                <div class="product-card">
                    <img src="../images/eru.png" alt="Eru" class="product-img">
                    <div class="product-name">Special Eru</div>
                    <p class="product-desc">Extra kanda and smoked fish portions.</p>
                    <div class="product-price">12.00</div>
                    <div class="product-footer">
                        <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>    
                        <div class="product-rating"><i class="fa fa-star"></i> 5.0</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button class="product-btn">See More Products <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>

    <!-- How it works Section -->
     <div class="container">
        
     </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>