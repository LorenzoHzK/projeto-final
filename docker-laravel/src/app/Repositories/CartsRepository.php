<?php

namespace App\Repositories;

use App\Models\Carts;

class CartsRepository
{
    public function all()
    {
        return Carts::all();
    }

    public function find($id)
    {
        return Carts::find($id);
    }

    public function create(array $data)
    {
        return Carts::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        return $category->update($data);
    }
}
