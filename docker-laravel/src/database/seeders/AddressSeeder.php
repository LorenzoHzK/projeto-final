<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::create(['user_id' => 1, 'street' => 'Rua A', 'number' => 123, 'zipcode' => '12345000', 'city' => 'São Paulo', 'state' => 'SP', 'country' => 'Brasil']);
        Address::create(['user_id' => 2, 'street' => 'Rua B', 'number' => 456, 'zipcode' => '65432000', 'city' => 'Curitiba', 'state' => 'PR', 'country' => 'Brasil']);
        Address::create(['user_id' => 3, 'street' => 'Rua C', 'number' => 789, 'zipcode' => '98765000', 'city' => 'Recife', 'state' => 'PE', 'country' => 'Brasil']);
    }
}
