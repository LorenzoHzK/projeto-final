<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    Public function run(): void
    {
        User::insert([
            ['name' => 'Carlos Mecânico', 'email' => 'carlos@oficina.com', 'password' => Hash::make('senha123'), 'role' => 'Client'],
            ['name' => 'João Vendas', 'email' => 'joao@pecas.com', 'password' => Hash::make('senha123'), 'role' => 'Moderator'],
            ['name' => 'Amanda Silva', 'email' => 'amanda@autopecas.com', 'password' => Hash::make('senha123'), 'role' => 'Admin'],
        ]);
    }
}
