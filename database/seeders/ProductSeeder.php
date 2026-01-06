<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create some categories
        $categories = [
            ['id' => 1, 'name' => 'Electronics', 'slug' => 'electronics', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Fashion', 'slug' => 'fashion', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Home & Living', 'slug' => 'home-living', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['id' => $category['id']],
                $category
            );
        }

        // Create 10 dummy products
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'Premium wireless headphones with active noise cancellation, 30-hour battery life, and crystal-clear audio quality. Features comfortable over-ear design with memory foam cushions.',
                'brief_description' => 'Premium ANC headphones with 30h battery',
                'price' => 149.99,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400',
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Smart Watch Pro',
                'description' => 'Feature-packed smartwatch with heart rate monitoring, GPS tracking, sleep analysis, and 50+ workout modes. Water-resistant up to 50 meters.',
                'brief_description' => 'Advanced smartwatch with health tracking',
                'price' => 299.99,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400',
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Laptop Stand Aluminum',
                'description' => 'Ergonomic aluminum laptop stand with adjustable height. Compatible with all laptops from 10-17 inches. Improves posture and cooling.',
                'brief_description' => 'Ergonomic adjustable aluminum stand',
                'price' => 45.99,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400',
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Vintage Leather Jacket',
                'description' => 'Classic vintage-style leather jacket made from genuine cowhide leather. Features a slim fit design with zippered pockets and quilted lining.',
                'brief_description' => 'Genuine leather vintage-style jacket',
                'price' => 249.99,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400',
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Running Sneakers Ultra',
                'description' => 'Lightweight running shoes with responsive cushioning and breathable mesh upper. Perfect for daily runs and workouts.',
                'brief_description' => 'Lightweight breathable running shoes',
                'price' => 129.99,
                'stock' => 75,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400',
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Designer Sunglasses',
                'description' => 'Trendy polarized sunglasses with UV400 protection. Lightweight titanium frame with scratch-resistant lenses.',
                'brief_description' => 'Polarized UV400 titanium sunglasses',
                'price' => 89.99,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400',
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Minimalist Desk Lamp',
                'description' => 'Modern LED desk lamp with touch dimmer and 3 color temperatures. USB charging port included. Perfect for home office.',
                'brief_description' => 'Modern LED lamp with USB charging',
                'price' => 59.99,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=400',
                'category_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ceramic Plant Pot Set',
                'description' => 'Set of 3 minimalist ceramic plant pots with drainage holes and bamboo saucers. Perfect for succulents and small plants.',
                'brief_description' => 'Set of 3 ceramic pots with saucers',
                'price' => 34.99,
                'stock' => 80,
                'image' => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?w=400',
                'category_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Cozy Throw Blanket',
                'description' => 'Ultra-soft fleece throw blanket perfect for cozy nights. Machine washable and available in multiple colors.',
                'brief_description' => 'Ultra-soft fleece throw blanket',
                'price' => 39.99,
                'stock' => 90,
                'image' => 'https://images.unsplash.com/photo-1580301762395-21ce84d00bc6?w=400',
                'category_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Mechanical Keyboard RGB',
                'description' => 'Premium mechanical keyboard with customizable RGB lighting, hot-swappable switches, and aircraft-grade aluminum frame.',
                'brief_description' => 'RGB mechanical keyboard with hot-swap',
                'price' => 159.99,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=400',
                'category_id' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['name' => $product['name']],
                array_merge($product, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
