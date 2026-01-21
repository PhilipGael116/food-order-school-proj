-- Create database
CREATE DATABASE IF NOT EXISTS restaurant CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE restaurant;

-- Users table (simplified - only email and password)
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    is_active BOOLEAN DEFAULT TRUE,
    `order` INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Menu items table
CREATE TABLE IF NOT EXISTS menu_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    price DECIMAL(10, 2) NOT NULL,
    discount_price DECIMAL(10, 2) NULL,
    image VARCHAR(255) NULL,
    is_available BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    order_number VARCHAR(255) NOT NULL UNIQUE,
    status ENUM('pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    payment_method ENUM('cash', 'card', 'online') NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    tax DECIMAL(10, 2) DEFAULT 0,
    delivery_fee DECIMAL(10, 2) DEFAULT 0,
    discount DECIMAL(10, 2) DEFAULT 0,
    total DECIMAL(10, 2) NOT NULL,
    delivery_address TEXT NOT NULL,
    delivery_phone VARCHAR(20) NOT NULL,
    notes TEXT NULL,
    estimated_delivery_time TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    menu_item_id BIGINT UNSIGNED NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    special_instructions TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

-- Insert sample categories
INSERT INTO categories (name, slug, is_active, `order`, created_at, updated_at) VALUES
('Traditional Dishes', 'traditional-dishes', TRUE, 1, NOW(), NOW()),
('Special Delights', 'special-delights', TRUE, 2, NOW(), NOW()),
('Local Beverages', 'local-beverages', TRUE, 3, NOW(), NOW());

-- Insert menu items
INSERT INTO menu_items (category_id, name, slug, description, price, is_available, is_featured, image, created_at, updated_at) VALUES
(1, 'Ndole & Miondo', 'ndole---miondo', 'Authentic Cameroonian meal prepared with fresh ingredients.', 3500, TRUE, TRUE, '../images/ndole.png', NOW(), NOW()),
(1, 'Eru & Water Fufu', 'eru---water-fufu', 'Authentic Cameroonian meal prepared with fresh ingredients.', 3500, TRUE, TRUE, '../images/eru.png', NOW(), NOW()),
(1, 'Achu & Yellow Soup', 'achu---yellow-soup', 'Authentic Cameroonian meal prepared with fresh ingredients.', 3000, TRUE, TRUE, '../images/achu.png', NOW(), NOW()),
(2, 'Perfect Jollof Rice', 'perfect-jollof-rice', 'Authentic Cameroonian meal prepared with fresh ingredients.', 2500, TRUE, TRUE, '../images/jollof.png', NOW(), NOW()),
(1, 'Yellow Koki Beans', 'yellow-koki-beans', 'Authentic Cameroonian meal prepared with fresh ingredients.', 2000, TRUE, TRUE, '../images/ndole.png', NOW(), NOW()),
(2, 'Poulet DG', 'poulet-dg', 'Authentic Cameroonian meal prepared with fresh ingredients.', 5000, TRUE, TRUE, '../images/eru.png', NOW(), NOW()),
(2, 'Kati Kati Chicken', 'kati-kati-chicken', 'Authentic Cameroonian meal prepared with fresh ingredients.', 4000, TRUE, TRUE, '../images/testimonial-platter.png', NOW(), NOW()),
(1, 'Okok', 'okok', 'Authentic Cameroonian meal prepared with fresh ingredients.', 2500, TRUE, TRUE, '../images/ndole.png', NOW(), NOW());
