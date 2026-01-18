<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Coupon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@restaurant.com',
            'password' => Hash::make('admin123'),
            'phone' => '+1234567890',
            'address' => '123 Admin Street',
            'role' => 'admin',
        ]);

        // Create customer user
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('customer123'),
            'phone' => '+0987654321',
            'address' => '456 Customer Avenue',
            'role' => 'customer',
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Appetizers',
                'description' => 'Start your meal with our delicious appetizers',
                'order' => 1,
            ],
            [
                'name' => 'Main Courses',
                'description' => 'Hearty and satisfying main dishes',
                'order' => 2,
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats to end your meal',
                'order' => 3,
            ],
            [
                'name' => 'Beverages',
                'description' => 'Refreshing drinks and beverages',
                'order' => 4,
            ],
            [
                'name' => 'Salads',
                'description' => 'Fresh and healthy salad options',
                'order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
                'order' => $category['order'],
            ]);
        }

        // Create menu items
        $menuItems = [
            // Appetizers
            [
                'category_id' => 1,
                'name' => 'Spring Rolls',
                'description' => 'Crispy vegetable spring rolls served with sweet chili sauce',
                'price' => 8.99,
                'is_vegetarian' => true,
                'is_featured' => true,
                'preparation_time' => 10,
                'calories' => 250,
            ],
            [
                'category_id' => 1,
                'name' => 'Buffalo Wings',
                'description' => 'Spicy chicken wings with blue cheese dip',
                'price' => 12.99,
                'preparation_time' => 15,
                'calories' => 450,
            ],
            [
                'category_id' => 1,
                'name' => 'Mozzarella Sticks',
                'description' => 'Golden fried mozzarella with marinara sauce',
                'price' => 9.99,
                'is_vegetarian' => true,
                'preparation_time' => 12,
                'calories' => 380,
            ],

            // Main Courses
            [
                'category_id' => 2,
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon with lemon butter sauce and vegetables',
                'price' => 24.99,
                'is_featured' => true,
                'preparation_time' => 25,
                'calories' => 520,
            ],
            [
                'category_id' => 2,
                'name' => 'Beef Burger',
                'description' => 'Angus beef burger with cheese, lettuce, tomato, and fries',
                'price' => 16.99,
                'discount_price' => 14.99,
                'preparation_time' => 20,
                'calories' => 780,
            ],
            [
                'category_id' => 2,
                'name' => 'Vegetarian Pasta',
                'description' => 'Penne pasta with fresh vegetables in tomato basil sauce',
                'price' => 15.99,
                'is_vegetarian' => true,
                'is_vegan' => true,
                'preparation_time' => 18,
                'calories' => 420,
            ],
            [
                'category_id' => 2,
                'name' => 'Chicken Tikka Masala',
                'description' => 'Tender chicken in creamy tomato curry sauce with basmati rice',
                'price' => 18.99,
                'is_featured' => true,
                'preparation_time' => 22,
                'calories' => 650,
            ],

            // Salads
            [
                'category_id' => 5,
                'name' => 'Caesar Salad',
                'description' => 'Crisp romaine lettuce with Caesar dressing, croutons, and parmesan',
                'price' => 11.99,
                'is_vegetarian' => true,
                'preparation_time' => 8,
                'calories' => 320,
            ],
            [
                'category_id' => 5,
                'name' => 'Greek Salad',
                'description' => 'Fresh vegetables with feta cheese and olives',
                'price' => 10.99,
                'is_vegetarian' => true,
                'preparation_time' => 10,
                'calories' => 280,
            ],

            // Desserts
            [
                'category_id' => 3,
                'name' => 'Chocolate Lava Cake',
                'description' => 'Warm chocolate cake with molten center and vanilla ice cream',
                'price' => 8.99,
                'is_vegetarian' => true,
                'preparation_time' => 15,
                'calories' => 550,
            ],
            [
                'category_id' => 3,
                'name' => 'Cheesecake',
                'description' => 'New York style cheesecake with berry compote',
                'price' => 7.99,
                'is_vegetarian' => true,
                'preparation_time' => 5,
                'calories' => 420,
            ],
            [
                'category_id' => 3,
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with coffee and mascarpone',
                'price' => 8.99,
                'is_vegetarian' => true,
                'is_featured' => true,
                'preparation_time' => 5,
                'calories' => 380,
            ],

            // Beverages
            [
                'category_id' => 4,
                'name' => 'Fresh Lemonade',
                'description' => 'Freshly squeezed lemon juice with mint',
                'price' => 4.99,
                'is_vegetarian' => true,
                'is_vegan' => true,
                'preparation_time' => 5,
                'calories' => 120,
            ],
            [
                'category_id' => 4,
                'name' => 'Iced Coffee',
                'description' => 'Cold brew coffee with milk and ice',
                'price' => 5.99,
                'is_vegetarian' => true,
                'preparation_time' => 3,
                'calories' => 80,
            ],
            [
                'category_id' => 4,
                'name' => 'Smoothie Bowl',
                'description' => 'Mixed berry smoothie with granola and fresh fruits',
                'price' => 9.99,
                'is_vegetarian' => true,
                'is_vegan' => true,
                'preparation_time' => 8,
                'calories' => 350,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'price' => $item['price'],
                'discount_price' => $item['discount_price'] ?? null,
                'is_available' => true,
                'is_featured' => $item['is_featured'] ?? false,
                'is_vegetarian' => $item['is_vegetarian'] ?? false,
                'is_vegan' => $item['is_vegan'] ?? false,
                'preparation_time' => $item['preparation_time'],
                'calories' => $item['calories'],
            ]);
        }

        // Create coupons
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percentage',
            'value' => 10,
            'min_order_amount' => 20,
            'usage_limit' => 100,
            'is_active' => true,
            'valid_until' => now()->addMonths(3),
        ]);

        Coupon::create([
            'code' => 'SAVE5',
            'type' => 'fixed',
            'value' => 5,
            'min_order_amount' => 30,
            'is_active' => true,
            'valid_until' => now()->addMonths(1),
        ]);
    }
}
