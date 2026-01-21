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
            'phone' => '+237123456789',
            'address' => 'Yaoundé, Cameroon',
            'role' => 'admin',
        ]);

        // Create customer user
        User::create([
            'name' => 'Philip Gael',
            'email' => 'philip@example.com',
            'password' => Hash::make('password123'),
            'phone' => '+237987654321',
            'address' => 'Douala, Cameroon',
            'role' => 'customer',
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Traditional Dishes',
                'description' => 'Authentic Cameroonian traditional meals',
                'order' => 1,
            ],
            [
                'name' => 'Special Delights',
                'description' => 'Chef\'s special Cameroonian recipes',
                'order' => 2,
            ],
            [
                'name' => 'Local Beverages',
                'description' => 'Refreshing local drinks',
                'order' => 3,
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
            // Traditional Dishes
            [
                'category_id' => 1,
                'name' => 'Special Eru & Water Fufu',
                'description' => 'Fine shredded Gnetum africanum leaves cooked with waterleaf, palm oil, and assorted meats, served with water fufu.',
                'price' => 3500,
                'is_featured' => true,
                'image' => '../images/eru.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Creamy Ndole & Miondo',
                'description' => 'Prepared with bitter leaves, peanuts, and choice of meat or fish, served with traditional Miondo.',
                'price' => 3500,
                'is_featured' => true,
                'image' => '../images/ndole.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Achu & Yellow Soup',
                'description' => 'Pounded cocoyam served with a spicy, aromatic yellow limestone soup and various meats.',
                'price' => 3000,
                'is_featured' => true,
                'image' => '../images/achu.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Kati Kati & Fufu Corn',
                'description' => 'Grilled chicken cooked in a special traditional sauce, served with yellow corn fufu.',
                'price' => 4000,
                'is_featured' => false,
                'image' => '../images/katikati.png',
            ],

            // Special Delights
            [
                'category_id' => 2,
                'name' => 'Jollof Rice & Chicken',
                'description' => 'Classic spicy Jollof rice served with golden fried chicken and plantains.',
                'price' => 2500,
                'is_featured' => true,
                'image' => '../images/jollof.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Poulet DG',
                'description' => 'Director General Chicken - a delicious mix of chicken, plantains, and vegetables in tomato sauce.',
                'price' => 5000,
                'is_featured' => true,
                'image' => '../images/poulet_dg.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Roasted Fish & Plantains',
                'description' => 'Spicy charcoal-grilled fish served with roasted plantains and pepper sauce.',
                'price' => 4500,
                'is_featured' => false,
                'image' => '../images/fish.png',
            ],

            // Beverages
            [
                'category_id' => 3,
                'name' => 'Fresh Palm Wine',
                'description' => 'Sweet, freshly tapped local palm wine.',
                'price' => 1500,
                'is_featured' => false,
                'image' => '../images/palmwine.png',
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'price' => $item['price'],
                'is_available' => true,
                'is_featured' => $item['is_featured'],
                'image' => $item['image'],
            ]);
        }

        // Create coupons
        Coupon::create([
            'code' => 'WELCOMEFCFA',
            'type' => 'fixed',
            'value' => 500,
            'min_order_amount' => 5000,
            'usage_limit' => 100,
            'is_active' => true,
            'valid_until' => now()->addMonths(3),
        ]);
    }
}
