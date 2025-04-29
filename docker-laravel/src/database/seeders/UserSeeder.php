<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    Public function run(): void
    {
        User::create(['name' => 'Matheus Lorenzo', 'email' => 'matheus@example.com', 'password' => Hash::make('12345678')]);
        User::create(['name' => 'Ana Silva', 'email' => 'ana@example.com', 'password' => Hash::make('12345678')]);
        User::create(['name' => 'Carlos Souza', 'email' => 'carlos@example.com', 'password' => Hash::make('12345678')]);
    }
}
