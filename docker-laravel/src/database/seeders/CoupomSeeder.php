<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CoupomSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create(['code' => 'BEMVINDO10', 'discount_percent' => 10]);
        Coupon::create(['code' => 'FRETEGRATIS', 'discount_percent' => 15]);
        Coupon::create(['code' => 'YUMMU20', 'discount_percent' => 20]);
    }
}
