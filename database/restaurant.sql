-- Restaurant Database Schema
-- Run this in phpMyAdmin to create all tables

-- Create database (if not exists)
CREATE DATABASE IF NOT EXISTS restaurant CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE restaurant;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Menu Items table
CREATE TABLE IF NOT EXISTS menu_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    is_available BOOLEAN DEFAULT TRUE,
    is_featured BOOLEAN DEFAULT FALSE,
    preparation_time INT DEFAULT 15,
    ingredients JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    order_number VARCHAR(255) NOT NULL UNIQUE,
    status ENUM('pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled') DEFAULT 'pending',
    subtotal DECIMAL(10, 2) NOT NULL,
    tax DECIMAL(10, 2) DEFAULT 0.00,
    delivery_fee DECIMAL(10, 2) DEFAULT 0.00,
    total DECIMAL(10, 2) NOT NULL,
    payment_method ENUM('cash', 'card', 'online') DEFAULT 'cash',
    payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    delivery_address TEXT NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    notes TEXT,
    estimated_delivery_time TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Order Items table
CREATE TABLE IF NOT EXISTS order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    menu_item_id BIGINT UNSIGNED NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    special_instructions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Personal Access Tokens table (for Laravel Sanctum)
CREATE TABLE IF NOT EXISTS personal_access_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    abilities TEXT,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type, tokenable_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
-- Admin user (password: password)
INSERT INTO users (name, email, password, phone, address, role) VALUES
('Admin User', 'admin@restaurant.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1234567890', '123 Admin Street', 'admin');

-- Sample customer (password: password)
INSERT INTO users (name, email, password, phone, address, role) VALUES
('John Doe', 'customer@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0987654321', '456 Customer Ave', 'customer');

-- Categories
INSERT INTO categories (name, slug, description, image, is_active) VALUES
('Pizza', 'pizza', 'Delicious handcrafted pizzas with fresh ingredients', 'https://images.unsplash.com/photo-1513104890138-7c749659a591', TRUE),
('Burgers', 'burgers', 'Juicy burgers made with premium beef', 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd', TRUE),
('Pasta', 'pasta', 'Traditional Italian pasta dishes', 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9', TRUE),
('Drinks', 'drinks', 'Refreshing beverages and drinks', 'https://images.unsplash.com/photo-1544145945-f90425340c7e', TRUE);

-- Menu Items
INSERT INTO menu_items (category_id, name, slug, description, price, image, is_available, is_featured, preparation_time, ingredients) VALUES
(1, 'Margherita Pizza', 'margherita-pizza', 'Classic pizza with tomato sauce, mozzarella, and fresh basil', 12.99, 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002', TRUE, TRUE, 20, '["Tomato Sauce","Mozzarella","Fresh Basil","Olive Oil"]'),
(1, 'Pepperoni Pizza', 'pepperoni-pizza', 'Loaded with pepperoni and extra cheese', 14.99, 'https://images.unsplash.com/photo-1628840042765-356cda07504e', TRUE, TRUE, 20, '["Tomato Sauce","Mozzarella","Pepperoni"]'),
(2, 'Classic Cheeseburger', 'classic-cheeseburger', 'Juicy beef patty with cheddar cheese, lettuce, tomato, and special sauce', 10.99, 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd', TRUE, TRUE, 15, '["Beef Patty","Cheddar Cheese","Lettuce","Tomato","Special Sauce","Sesame Bun"]'),
(2, 'Bacon Burger', 'bacon-burger', 'Double beef patty with crispy bacon and melted cheese', 13.99, 'https://images.unsplash.com/photo-1553979459-d2229ba7433b', TRUE, FALSE, 18, '["Double Beef Patty","Bacon","Cheese","Lettuce","Onion"]'),
(3, 'Spaghetti Carbonara', 'spaghetti-carbonara', 'Creamy pasta with bacon, eggs, and parmesan cheese', 13.99, 'https://images.unsplash.com/photo-1612874742237-6526221588e3', TRUE, FALSE, 25, '["Spaghetti","Bacon","Eggs","Parmesan","Black Pepper"]'),
(3, 'Penne Arrabbiata', 'penne-arrabbiata', 'Spicy tomato sauce with garlic and red chili peppers', 11.99, 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9', TRUE, FALSE, 20, '["Penne Pasta","Tomato Sauce","Garlic","Red Chili","Olive Oil"]'),
(4, 'Coca Cola', 'coca-cola', 'Classic refreshing soft drink', 2.99, 'https://images.unsplash.com/photo-1554866585-cd94860890b7', TRUE, FALSE, 2, '["Coca Cola"]'),
(4, 'Fresh Orange Juice', 'fresh-orange-juice', 'Freshly squeezed orange juice', 4.99, 'https://images.unsplash.com/photo-1600271886742-f049cd451bba', TRUE, FALSE, 5, '["Fresh Oranges"]');
