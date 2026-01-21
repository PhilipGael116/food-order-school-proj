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

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="all-products-container">
                    <!-- Products will be loaded here dynamically -->
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                        <p>Discovering our flavors...</p>
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
    <script src="../js/product-loader.js"></script>
    <script>
        $(document).ready(async function() {
            // Load all products
            const products = await productLoader.fetchAllProducts();
            productLoader.renderProducts(products, 'all-products-container');

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
