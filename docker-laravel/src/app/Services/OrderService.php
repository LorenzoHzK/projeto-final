<?php

namespace app\Services;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Coupon;
use App\Repositories\OrderRepository;
use App\Services\OrderItemService;
use Illuminate\Http\Request;

class OrderService
{
    public function __construct(
        protected OrderRepository  $ordersRepository,
        protected OrderItemService $orderItemService,
        protected Request          $request)
    {
    }

    public function showOrders()
    {
        $userId = auth()->id();

        $orders = Order::where('user_id', $userId)->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'message' => 'Dont have orders'
            ]);
        }

        return response()->json($orders);
    }


    public function createOrders()
    {
        $user = auth()->user()->id;
        $cart = Cart::where('user_id', $user)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        if ($cartItems->isEmpty()) {
            return response()->json([
                'message' => 'Cart is empty',
            ]);
        }
        $total['totalAmount'] = $cartItems->sum(
            function ($item) {
                return $item->unit_price * $item->quantity;
            });

        $validatedData = $this->request->validate([
            'address_id' => 'required|int|exists:addresses,id',
            'cupon_id' => 'nullable|exists:coupons,id'
        ]);


        if (!$validatedData['address_id']) {
            return response()->json([
                'message' => 'Address is required'
            ]);
        }

        $validatedData['orderDate'] = date('Y-m-d H:i:s');
        $validatedData['totalAmount'] = $total['totalAmount'];
        $validatedData['user_id'] = $user;
        $validatedData['status'] = 'pending';

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found', 404,
                ]);
            }

            if ($cartItem->quantity > $product->stock) {
                return response()->json([
                    'message' => 'Product stock is not enough: ' . $product->name,
                    'product_id' => $product->id,
                ], 400);
            }

            $product->stock -= $cartItem->quantity;
            $product->save();
        }

        if (!empty($validatedData['cupon_id'])) {
            $coupon = Coupon::find($validatedData['cupon_id']);

            if ($coupon) {
                $couponDiscount = $coupon->discount;
                $discountValue = $total['totalAmount'] * $couponDiscount;
                $total['totalAmount'] -= $discountValue;
                $validatedData['totalAmount'] = $total['totalAmount'];
            }
        }

        $Order = $this->ordersRepository->create($validatedData);
        if ($validatedData) {
            $this->orderItemService->createFromCart($Order->id, $cartItems);
            CartItem::where('cart_id', $cart->id)->delete();
        }

        return response()->json([
            'message' => 'Order created with success',
            'data' => $Order
        ], 201);
    }

    public function specificOrders($order_id)
    {
        $user = auth()->user()->id;
        $order = Order::where('id', $order_id)->where('user_id', $user)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        return response()->json(['order' => $order]);
    }

    public function updateOrders($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        $validatedData = $this->request->validate([
            'status' => 'required|string|in:Processing,Shipped,Completed,Canceled'
        ]);

        $order->update($validatedData);

        return response()->json([
            'message' => 'Order updated with success',
            'Order' => $validatedData
        ]);
    }

    public function deleteOrders($order_id)
    {
        $user = auth()->user()->id;
        $order = Order::where('id', $order_id)->where('user_id', $user)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        OrderItem::where('order_id', $order->id)->delete();
        $order->delete();
        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}
