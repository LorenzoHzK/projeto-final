<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\OrderItemService;

class OrderController extends Controller
{

    public function __construct(
        protected OrderService $orderService,
        protected OrderItemService $orderItemService,
        protected Request $request)
    {}
   public function showOrders()
   {
       return $this->orderService->showOrders();
   }

   public function createOrders()
   {
       return $this->orderService->createOrders();
   }

   public function specificOrders(int $order_id)
   {
        return $this->orderService->specificOrders($order_id);
   }

   public function updateOrders($order_id)
   {
       return $this->orderService->updateOrders($order_id);
   }

   public function deleteOrders($order_id)
   {
       return $this->orderService->deleteOrders($order_id);
   }
}
