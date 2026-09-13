<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Client::create([
            'name' => 'Administrador Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('password456'),
            'role' => 'admin',
            'address' => 'Calle Principal #123',
            'phone' => '3001234567',
        ]);

        Client::create([
            'name' => 'Lila Perez',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password123'),
            'role' => 'client',
            'address' => 'Avenida Secundaria #456',
            'phone' => '3119876543',
        ]);
        
        Client::factory()->count(10)->create();
    }
}
