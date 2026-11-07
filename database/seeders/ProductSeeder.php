<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

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
            [
                'name' => 'Micellar Cleansing Water',
                'brand' => 'LUMÉ SKIN',
                'price' => 19.90,
                'description' => 'No-rinse micellar water that gently lifts makeup and impurities, ideal for sensitive skin.',
                'stock' => 55,
                'image' => 'cleanser3.jpg',
                'category_id' => $cleansers?->getId(),
                'featured' => false,
            ],
            [
                'name' => 'Toleriane Hydrating Gentle Cleanser',
                'brand' => 'LUMÉ SKIN',
                'price' => 26.00,
                'description' => 'Creamy cleanser with ceramides and niacinamide that cleans while preserving the skin barrier.',
                'stock' => 42,
                'image' => 'cleanser4.jpg',
                'category_id' => $cleansers?->getId(),
                'featured' => false,
            ],
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
            [
                'name' => 'Niacinamide 10% + Zinc 1% Serum',
                'brand' => 'LUMÉ SKIN',
                'price' => 18.50,
                'description' => 'Lightweight serum that reduces the look of pores and balances excess oil.',
                'stock' => 48,
                'image' => 'serum3.jpg',
                'category_id' => $serums?->getId(),
                'featured' => false,
            ],
            [
                'name' => 'Retinol 0.5% Night Serum',
                'brand' => 'LUMÉ SKIN',
                'price' => 21.00,
                'description' => 'Squalane-based retinol serum that smooths texture and fine lines overnight.',
                'stock' => 30,
                'image' => 'serum4.jpg',
                'category_id' => $serums?->getId(),
                'featured' => false,
            ],
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
            [
                'name' => 'Double Repair Face Moisturizer',
                'brand' => 'LUMÉ SKIN',
                'price' => 32.00,
                'description' => 'Daily moisturizer with prebiotic water and ceramides that restores comfort for up to 48 hours.',
                'stock' => 38,
                'image' => 'moisturizer3.jpg',
                'category_id' => $moisturizers?->getId(),
                'featured' => false,
            ],
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
            [
                'name' => 'Fusion Water Sunscreen SPF 50',
                'brand' => 'LUMÉ SKIN',
                'price' => 31.50,
                'description' => 'Ultra-light water-based sunscreen that absorbs instantly, perfect for daily use.',
                'stock' => 44,
                'image' => 'sunscreen2.jpg',
                'category_id' => $sunscreens?->getId(),
                'featured' => false,
            ],
            [
                'name' => 'UVmune 400 Fluid SPF 50+',
                'brand' => 'LUMÉ SKIN',
                'price' => 35.00,
                'description' => 'Very high protection fluid against UVA, UVB and ultra-long UVA rays.',
                'stock' => 36,
                'image' => 'sunscreen3.jpg',
                'category_id' => $sunscreens?->getId(),
                'featured' => false,
            ],
        ];

        foreach ($products as $data) {
            if ($data['category_id'] !== null) {
                $product = new Product;
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
