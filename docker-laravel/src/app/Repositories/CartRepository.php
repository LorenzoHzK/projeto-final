<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function all()
    {
        return Cart::all();
    }

    public function find($id)
    {
        return Cart::find($id);
    }

    public function create(array $data)
    {
        return Cart::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        return $category->update($data);
    }
}
