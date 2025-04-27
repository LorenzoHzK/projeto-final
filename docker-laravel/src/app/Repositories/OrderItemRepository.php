<?php

namespace app\Repositories;
use App\Models\OrderItem;

class OrderItemRepository
{
    public function create($data)
    {
        return OrderItem::create($data);
    }
}
