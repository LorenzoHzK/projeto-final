<?php

namespace app\Repositories;

use App\Models\CartItem;
use App\Models\Product;

class CartItemRepository
{
    public function __construct(protected CartItem $model){
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $validatedData)
    {
        $product = Product::find($validatedData['product_id']);
        if ($validatedData['quantity'] > $product->stock) {
            return 'stock_insufficient';
        }

        $cartItem = $this->model->where('product_id', $validatedData['product_id'])->first();
        if (!$cartItem) {
            return null;
        }

        $cartItem->quantity = $validatedData['quantity'];
        $cartItem->save();

        return $cartItem;
    }
}
