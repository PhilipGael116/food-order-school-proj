<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Cameroonian Delights</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../menu.css">
</head>

<body>

    <!-- Header -->
    <?php include '../components/header.php'; ?>

    <main class="menu-section container">
        <!-- Top Banner -->
        <div class="menu-banner">
            <div class="banner-content">
                <h1 class="banner-title">Let's order now food at <span class="text-tangerine">Gael's Kitchen</span></h1>
                <p class="banner-desc">The foods here are guaranteed to be delicious and very healthy, of course Cameroonian pride.</p>
            </div>
            <div class="banner-img-container d-none d-md-block">
                <!-- Using a chef image if available, or a placeholder -->
                <img src="../images/chef.png" alt="Chef" class="banner-img">
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar: Meal Info-->
            <div class="col-lg-4 mb-5">
                <div class="menu-sidebar">
                    <h3 class="sidebar-title">Meal Info</h3>
                    
                    <!-- Selected Items (Categorized as per user request) -->
                    <div class="category-block mb-4">
                        <p class="text-muted small fw-bold text-uppercase mb-3">Main Traditional Dishes</p>
                        
                        <!-- Item 1 -->
                        <div class="order-item-card">
                            <img src="../images/ndole.png" alt="Ndole" class="order-item-img">
                            <div class="order-item-info">
                                <h4 class="order-item-name">Ndole</h4>
                                <div class="order-item-rating">
                                    <i class="fas fa-star text-warning"></i> 4.8 
                                </div>
                                <div class="order-item-desc text-muted small mt-1">
                                    Creamy bitterleaf stew with prawns and beef, served with fresh miondo.
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="order-item-card">
                            <img src="../images/eru.png" alt="Eru" class="order-item-img">
                            <div class="order-item-info">
                                <h4 class="order-item-name">Special Eru</h4>
                                <div class="order-item-rating">
                                    <i class="fas fa-star text-warning"></i> 4.2 
                                </div>
                                <div class="order-item-desc text-muted small mt-1">
                                    Traditional vegetable soup with water fufu and smoked fish.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Food Grid -->
            <div class="col-lg-8">
                <div class="menu-header">
                    <h2>Based on the type of food you like</h2>
                    <a href="#" class="view-all">View all</a>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-5">
                    <!-- Food Item Card 1 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/ndole.png" alt="Ndole" class="product-img">
                            <div class="product-name">Ndole & Miondo</div>
                            <p class="product-desc">Creamy bitter leaves with cassava.</p>
                            <div class="product-price">3500</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.8</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 2 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/eru.png" alt="Eru" class="product-img">
                            <div class="product-name">Eru & Water Fufu</div>
                            <p class="product-desc">Rich traditional vegetables with fufu.</p>
                            <div class="product-price">3500</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.2</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 3 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/achu.png" alt="Achu" class="product-img">
                            <div class="product-name">Achu & Yellow Soup</div>
                            <p class="product-desc">Taro paste with savory yellow soup.</p>
                            <div class="product-price">3000</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.1</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 4 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/jollof.png" alt="Jollof" class="product-img">
                            <div class="product-name">Perfect Jollof Rice</div>
                            <p class="product-desc">Authentic smoky flavor with fried plantain.</p>
                            <div class="product-price">2500</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.9</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 5 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/ndole.png" alt="Koki" class="product-img">
                            <div class="product-name">Yellow Koki Beans</div>
                            <p class="product-desc">Creamy beans cake with palm oil.</p>
                            <div class="product-price">2000</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.5</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 6 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/eru.png" alt="Poulet DG" class="product-img">
                            <div class="product-name">Poulet DG</div>
                            <p class="product-desc">Director General Chicken with plantains.</p>
                            <div class="product-price">5000</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.7</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 7 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/achu.png" alt="Kati Kati" class="product-img">
                            <div class="product-name">Kati Kati Chicken</div>
                            <p class="product-desc">Traditional roasted chicken with spices.</p>
                            <div class="product-price">4000</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.6</div>
                            </div>
                        </div>
                    </div>

                    <!-- Food Item Card 8 -->
                    <div class="col">
                        <div class="product-card">
                            <img src="../images/ndole.png" alt="Okok" class="product-img">
                            <div class="product-name">Okok</div>
                            <p class="product-desc">Gnetum leaves with groundnuts and sugar.</p>
                            <div class="product-price">2500</div>
                            <div class="product-footer">
                                <button class="product-btn">Add to Cart <i class="fa fa-cart-plus"></i></button>
                                <div class="product-rating"><i class="fa fa-star"></i> 4.2</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/product-cart.js"></script>
</body>

</html>
