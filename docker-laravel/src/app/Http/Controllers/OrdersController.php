<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrdersService;
use App\Services\OrderItemService;

class OrdersController extends Controller
{
    protected OrdersService $ordersService;
    protected OrderItemService $orderItemService;

    public function __construct(ordersService $ordersService, orderItemService $orderItemService)
    {
        $this->ordersService = $ordersService;
        $this->orderItemService = $orderItemService;
    }
   public function showOrders()
   {
       return $this->ordersService->showOrders();
   }

   public function createOrders(Request $request, OrderItemService $orderItemService)
   {
       return $this->ordersService->createOrders($request, $orderItemService);
   }

   public function specificOrders($order_id)
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
