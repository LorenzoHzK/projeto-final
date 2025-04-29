<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Suspensão', 'description' => 'Peças que compõem o sistema de suspensão do veículo.', 'created_by' => 3],
            ['name' => 'Interior', 'description' => 'Itens internos como bancos, volantes e acabamentos.', 'created_by' => 3],
            ['name' => 'Rodas', 'description' => 'Rodas de liga leve, aço e acessórios.', 'created_by' => 3],
        ]);
    }
}
