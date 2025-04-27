<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\OrderItemService;

class OrderController extends Controller
{

    public function __construct(protected OrderService $ordersService, OrderItemService $orderItemService, Request $request)
    {
        $this->OrderService = $ordersService;
        $this->OrderItemService = $orderItemService;
        $this->Request = $request;
    }
   public function showOrders()
   {
       return $this->ordersService->showOrders();
   }

   public function createOrders()
   {
       return $this->ordersService->createOrders();
   }

   public function specificOrders(int $order_id)
   {
        return $this->ordersService->specificOrders($order_id);
   }

   public function updateOrders($order_id)
   {
       return $this->ordersService->updateOrders($order_id);
   }

   public function deleteOrders($order_id)
   {
       return $this->ordersService->deleteOrders($order_id);
   }
}
