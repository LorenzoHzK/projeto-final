<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Repositories\OrderItemRepository;

class OrderItemService
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }
    public function createFromCart($orderId, $cartItems)
    {
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $orderId,
                'product_id' => $item->product_id,
                'unit_price' => $item->unit_price,
                'quantity'   => $item->quantity,
            ]);
        }
    }
}
