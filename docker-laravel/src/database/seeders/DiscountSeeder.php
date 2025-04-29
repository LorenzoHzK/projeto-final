<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        Discount::create(['name' => 'Black Friday', 'percent' => 50]);
        Discount::create(['name' => 'Natal', 'percent' => 30]);
        Discount::create(['name' => 'Queima de Estoque', 'percent' => 70]);
    }
}
