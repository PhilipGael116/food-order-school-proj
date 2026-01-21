// Product Loader - Handles fetching and rendering products from the API
class ProductLoader {
    async fetchFeaturedProducts() {
        try {
            const response = await fetch(`${CONFIG.API_URL}/menu/featured`);
            const data = await response.json();
            return data.success ? data.data : [];
        } catch (error) {
            console.error('Error fetching featured products:', error);
            return [];
        }
    }

    async fetchAllProducts(category = null) {
        try {
            let url = `${CONFIG.API_URL}/menu`;
            if (category) {
                url += `?category=${category}`;
            }
            const response = await fetch(url);
            const data = await response.json();
            return data.success ? data.data : [];
        } catch (error) {
            console.error('Error fetching products:', error);
            return [];
        }
    }

    renderProducts(products, containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        if (products.length === 0) {
            container.innerHTML = '<div class="col-12 text-center py-5"><p>No products found.</p></div>';
            return;
        }

        container.innerHTML = products.map(product => `
            <div class="col">
                <div class="product-card">
                    <img src="${product.image}" alt="${product.name}" class="product-img">
                    <div class="product-name">${product.name}</div>
                    <p class="product-desc">${product.description}</p>
                    <div class="product-price">${product.price}</div>
                    <div class="product-footer">
                        <button class="product-btn" 
                                data-id="${product.id}" 
                                data-name="${product.name}" 
                                data-price="${product.price}" 
                                data-image="${product.image}">
                            Add to Cart <i class="fa fa-cart-plus"></i>
                        </button>    
                        <div class="product-rating"><i class="fa fa-star"></i> ${product.rating || '4.5'}</div>
                    </div>
                </div>
            </div>
        `).join('');
    }
}

window.productLoader = new ProductLoader();
