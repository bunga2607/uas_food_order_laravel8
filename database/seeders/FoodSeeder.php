<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run()
    {
        Food::create([
            'name' => 'Nasi Goreng Spesial',
            'price' => 15000,
            'description' => 'Nasi goreng dengan telur, ayam, dan kerupuk.',
            'image' => 'nasi-goreng.jpg',
        ]);

        Food::create([
            'name' => 'Mie Ayam Bakso',
            'price' => 12000,
            'description' => 'Mie ayam dengan tambahan bakso dan sayur.',
            'image' => 'mie-ayam.jpg',
        ]);

        Food::create([
            'name' => 'Sate Ayam',
            'price' => 18000,
            'description' => 'Sate ayam dengan bumbu kacang dan lontong.',
            'image' => 'sate-ayam.jpg',
        ]);
    }
}
