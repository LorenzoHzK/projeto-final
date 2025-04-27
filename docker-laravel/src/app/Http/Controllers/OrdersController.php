<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\OrderItemService;

class OrdersController extends Controller
{
    protected OrderService $ordersService;
    protected OrderItemService $orderItemService;

    public function __construct(OrderService $ordersService, OrderItemService $orderItemService)
    {
        $this->ordersService = $ordersService;
        $this->orderItemService = $orderItemService;
    }
   public function showOrders()
   {
       return $this->ordersService->showOrders();
   }

   public function createOrders(Request $request)
   {
       return $this->ordersService->createOrders($request);
   }

   public function specificOrders(int $order_id)
   {
        return $this->ordersService->specificOrders($order_id);
   }

   public function updateOrders(Request $request, $order_id)
   {
       return $this->ordersService->updateOrders($request ,$order_id);
   }

   public function deleteOrders($order_id)
   {
       return $this->ordersService->deleteOrders($order_id);
   }
}
