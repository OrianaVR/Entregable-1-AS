<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cleansers',
                'description' => 'Gentle facial cleansers designed to purify and refresh the skin.',
            ],
            [
                'name' => 'Serums & Treatments',
                'description' => 'Concentrated active formulas targeting specific skin concerns.',
            ],
            [
                'name' => 'Moisturizers',
                'description' => 'Nourishing creams and gels to lock in moisture and protect the skin barrier.',
            ],
            [
                'name' => 'Sunscreens',
                'description' => 'Broad-spectrum UV protection essential for daily skin care.',
            ],
        ];

        foreach ($categories as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $category->setDescription($data['description']);
            $category->save();
        }
    }
}