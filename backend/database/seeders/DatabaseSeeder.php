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
            ['name' => 'Traditional Dishes', 'order' => 1],
            ['name' => 'Special Delights', 'order' => 2],
            ['name' => 'Local Beverages', 'order' => 3],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'is_active' => true,
                'order' => $category['order'],
            ]);
        }

        // Create menu items matching frontend IDs
        $menuItems = [
            [
                'category_id' => 1,
                'name' => 'Ndole & Miondo',
                'slug' => 'ndole---miondo',
                'price' => 3500,
                'image' => '../images/ndole.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Eru & Water Fufu',
                'slug' => 'eru---water-fufu',
                'price' => 3500,
                'image' => '../images/eru.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Achu & Yellow Soup',
                'slug' => 'achu---yellow-soup',
                'price' => 3000,
                'image' => '../images/achu.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Perfect Jollof Rice',
                'slug' => 'perfect-jollof-rice',
                'price' => 2500,
                'image' => '../images/jollof.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Yellow Koki Beans',
                'slug' => 'yellow-koki-beans',
                'price' => 2000,
                'image' => '../images/ndole.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Poulet DG',
                'slug' => 'poulet-dg',
                'price' => 5000,
                'image' => '../images/eru.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Kati Kati Chicken',
                'slug' => 'kati-kati-chicken',
                'price' => 4000,
                'image' => '../images/testimonial-platter.png',
            ],
            [
                'category_id' => 1,
                'name' => 'Okok',
                'slug' => 'okok',
                'price' => 2500,
                'image' => '../images/ndole.png',
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'description' => 'Authentic Cameroonian meal prepared with fresh ingredients.',
                'price' => $item['price'],
                'is_available' => true,
                'is_featured' => true,
                'image' => $item['image'],
            ]);
        }

        // Create coupon
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
