<?php

namespace app\Repositories;

use App\Models\CartItem;

class CartItemRepository
{
    public function all()
    {
        return CartItem::all();
    }

    public function find($id)
    {
        return CartItem::find($id);
    }

    public function create(array $data)
    {
        return CartItem::create($data);
    }

    public function update($validatedData)
    {
        $item = $this->find($validatedData['product_id']);
        $item->update($validatedData);
        return $item;
    }
}
