<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CoupomSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::insert([
        ['code' => 'AUTO10', 'startDate' => '2025-01-01', 'endDate' => '2025-12-31', 'discount' => 00.10],
        ['code' => 'PECA15', 'startDate' => '2025-05-01', 'endDate' => '2025-08-31', 'discount' => 00.15],
        ['code' => 'OFICINA5', 'startDate' => '2025-03-01', 'endDate' => '2025-07-01', 'discount' => 00.05],
        ]);
    }
}
