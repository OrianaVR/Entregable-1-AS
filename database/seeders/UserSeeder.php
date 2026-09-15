<?php

// AUTHOR: Maria Laura Tafur Gomez

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Main Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password456'),
            'role' => 'admin',
            'address' => '123 Main Street',
            'phone' => '3001234567',
        ]);

        User::create([
            'name' => 'Lila Perez',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'address' => '456 Second Avenue',
            'phone' => '3119876543',
        ]);

        User::factory()->count(10)->create();
    }
}
