<?php

namespace app\Repositories;
use App\Models\Carts;
use App\Models\Orders;

class OrdersRepository
{

    public function all()
    {
        return Orders::all();
    }

    public function create($validatedData)
    {
        return Orders::create($validatedData);
    }

    public function update($validatedData)
    {
        return Orders::update($validatedData);
    }

    public function delete()
    {
        return Orders::delete();
    }
}
