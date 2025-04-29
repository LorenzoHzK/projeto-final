<?php

namespace app\Repositories;
use App\Models\Cart;
use App\Models\Order;

class OrderRepository
{

    public function all($user)
    {
        return Order::all($user);
    }

    public function create($validatedData)
    {
        return Order::create($validatedData);
    }

    public function update($validatedData)
    {
        return Order::update($validatedData);
    }

    public function delete()
    {
        return Order::delete();
    }
}
