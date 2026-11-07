<?php

/**
 * @author Maria Laura Tafur Gómez
 * @author Ana Sofía Angarita Barrios
 */

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
