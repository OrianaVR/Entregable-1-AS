<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cleansers = Category::where('name', 'Cleansers')->first();
        $serums = Category::where('name', 'Serums & Treatments')->first();
        $moisturizers = Category::where('name', 'Moisturizers')->first();
        $sunscreens = Category::where('name', 'Sunscreens')->first();

        $products = [
            // Step 1: Cleansers
            [
                'name' => 'Gentle Foaming Cleanser',
                'brand' => 'LUMÉ SKIN',
                'price' => 24.99,
                'description' => 'Sulfate-free cleanser that removes makeup and impurities without drying the skin.',
                'stock' => 50,
                'image' => 'cleanser1.jpg',
                'category_id' => $cleansers?->getId(),
                'featured' => false,
            ],
            [
                'name' => 'Hydrating Amino Gel Cleanser',
                'brand' => 'LUMÉ SKIN',
                'price' => 22.50,
                'description' => 'Soothing gel cleanser rich in amino acids for daily moisture balance.',
                'stock' => 40,
                'image' => 'cleanser2.jpg',
                'category_id' => $cleansers?->getId(),
                'featured' => false,
            ],
            // Step 2: Serums & Treatments
            [
                'name' => 'Vitamin C Glow Serum',
                'brand' => 'LUMÉ SKIN',
                'price' => 38.00,
                'description' => 'Potent antioxidant serum formulated to brighten tone and reduce spots.',
                'stock' => 35,
                'image' => 'serum1.jpg',
                'category_id' => $serums?->getId(),
                'featured' => false,
            ],
            [
                'name' => 'Hyaluronic Acid Hydration Booster',
                'brand' => 'LUMÉ SKIN',
                'price' => 34.00,
                'description' => 'Multi-molecular hyaluronic serum providing deep, long-lasting hydration.',
                'stock' => 60,
                'image' => 'serum2.jpg',
                'category_id' => $serums?->getId(),
                'featured' => false,
            ],
            // Step 3: Moisturizers
            [
                'name' => 'Barrier Repair Moisture Cream',
                'brand' => 'LUMÉ SKIN',
                'price' => 42.00,
                'description' => 'Rich nourishing cream packed with ceramides to restore skin softness.',
                'stock' => 30,
                'image' => 'moisturizer1.jpg',
                'category_id' => $moisturizers?->getId(),
                'featured' => false,
            ],
            [
                'name' => 'Ultra-Light Water Gel Cream',
                'brand' => 'LUMÉ SKIN',
                'price' => 36.50,
                'description' => 'Oil-free hydrator with a featherlight texture ideal for oily skin types.',
                'stock' => 45,
                'image' => 'moisturizer2.jpg',
                'category_id' => $moisturizers?->getId(),
                'featured' => false,
            ],
            // Step 4: Sunscreens
            [
                'name' => 'Invisible Daily Defense SPF 50',
                'brand' => 'LUMÉ SKIN',
                'price' => 29.99,
                'description' => 'Lightweight broad-spectrum UV protection with no white cast or greasy feel.',
                'stock' => 50,
                'image' => 'sunscreen1.jpg',
                'category_id' => $sunscreens?->getId(),
                'featured' => false,
            ],
        ];

        foreach ($products as $data) {
            if ($data['category_id'] !== null) {
                $product = new Product();
                $product->setName($data['name']);
                $product->setBrand($data['brand']);
                $product->setPrice($data['price']);
                $product->setDescription($data['description']);
                $product->setStock($data['stock']);
                $product->setImage($data['image']);
                $product->setCategoryId($data['category_id']);
                $product->setFeatured($data['featured']);
                $product->save();
            }
        }
    }
}