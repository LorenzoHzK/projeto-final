<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create(['name' => 'Smartphone X', 'price' => 2500.00, 'category_id' => 1]);
        Product::create(['name' => 'Camisa Polo', 'price' => 120.00, 'category_id' => 2]);
        Product::create(['name' => 'Cesta Sem Glúten', 'price' => 80.00, 'category_id' => 3]);
    }
}
