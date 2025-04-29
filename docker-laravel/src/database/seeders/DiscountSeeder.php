<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        Discount::insert([
            [
                'description' => 'Promoção Suspensão',
                'startDate' => '2025-01-01',
                'endDate' => '2025-06-30',
                'discount' => 5.00,
                'product_id' => 1
            ],
            [
                'description' => 'Desconto Interior Luxo',
                'startDate' => '2025-02-15',
                'endDate' => '2025-09-30',
                'discount' => 10.00,
                'product_id' => 2
            ],
            [
                'description' => 'Promoção Rodas',
                'startDate' => '2025-04-01',
                'endDate' => '2025-12-01',
                'discount' => 15.00,
                'product_id' => 3
            ]
        ]);
    }
}
