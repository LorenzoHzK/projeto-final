<?php

namespace app\Repositories;
use App\Models\OrderItems;

class OrderItemRepository
{
    public function create($data)
    {
        return OrderItems::create($data);
    }
}
