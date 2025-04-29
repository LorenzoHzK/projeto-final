<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Amortecedor Traseiro Cofap',
                'category_id' => 1,
                'price' => 350.00,
                'stock' => 10,
                'image' => 'https://via.placeholder.com/150?text=Amortecedor',
                'original' => 1,
                'weight' => 5.2
            ],
            [
                'name' => 'Banco Esportivo Couro Preto',
                'category_id' => 2,
                'price' => 1200.00,
                'stock' => 5,
                'image' => 'https://via.placeholder.com/150?text=Banco',
                'original' => 1,
                'weight' => 12.0
            ],
            [
                'name' => 'Roda Aro 17 Liga Leve',
                'category_id' => 3,
                'price' => 899.99,
                'stock' => 7,
                'image' => 'https://via.placeholder.com/150?text=Roda',
                'original' => 1,
                'weight' => 8.5
            ]
        ]);
    }
}
