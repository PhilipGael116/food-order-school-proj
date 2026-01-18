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
            <!-- Left Sidebar: Order Flow -->
            <div class="col-lg-4 mb-5">
                <div class="menu-sidebar">
                    <h3 class="sidebar-title">Order Flow</h3>
                    
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

                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    <!-- Food Item Card 1 -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/ndole.png" alt="Ndole" class="food-img-circular">
                                <span class="price-tag">$18</span>
                            </div>
                            <h4 class="food-name">Ndole & Miondo</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.8 <span class="text-muted">(12K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Food Item Card 2 -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/eru.png" alt="Eru" class="food-img-circular">
                                <span class="price-tag">$15</span>
                            </div>
                            <h4 class="food-name">Eru & Water Fufu</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.2 <span class="text-muted">(19K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Food Item Card 3 -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/achu.png" alt="Achu" class="food-img-circular">
                                <span class="price-tag">$20</span>
                            </div>
                            <h4 class="food-name">Achu & Yellow Soup</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.1 <span class="text-muted">(10K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Food Item Card 4 -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/jollof.png" alt="Jollof" class="food-img-circular">
                                <span class="price-tag">$12</span>
                            </div>
                            <h4 class="food-name">Perfect Jollof Rice</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.9 <span class="text-muted">(25K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <!-- Koki (Placeholder image handle) -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/ndole.png" alt="Koki" class="food-img-circular">
                                <span class="price-tag">$10</span>
                            </div>
                            <h4 class="food-name">Yellow Koki Beans</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.5 <span class="text-muted">(8K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Poulet DG -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/eru.png" alt="Poulet DG" class="food-img-circular">
                                <span class="price-tag">$25</span>
                            </div>
                            <h4 class="food-name">Poulet DG</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.7 <span class="text-muted">(15K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Kati Kati -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/achu.png" alt="Kati Kati" class="food-img-circular">
                                <span class="price-tag">$15</span>
                            </div>
                            <h4 class="food-name">Kati Kati Chicken</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.6 <span class="text-muted">(11K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>

                    <!-- Okok -->
                    <div class="col">
                        <div class="food-item-card">
                            <div class="food-img-container">
                                <img src="../images/ndole.png" alt="Okok" class="food-img-circular">
                                <span class="price-tag">$15</span>
                            </div>
                            <h4 class="food-name">Okok</h4>
                            <div class="food-rating">
                                <i class="fas fa-star"></i> 4.2 <span class="text-muted">(9K reviews)</span>
                            </div>
                            <button class="btn-order">Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
