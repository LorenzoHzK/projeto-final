<?php

namespace app\Services;
use App\Models\CartItem;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\products;
use App\Models\Coupons;
use App\Repositories\OrdersRepository;

class OrdersService
{
    protected $ordersRepository;
    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }

    public function showOrders()
    {
        $user = auth()->user()->id;

        if (!Orders::where('user_id', $user)->exists())
        {
            return response()->json([
               'message' => 'Dont have orders'
            ]);
        }

        return $this->ordersRepository->all($user);
    }

    public function createOrders($request, $orderItemService)
    {
        $user = auth()->user()->id;
        $cart = Carts::where('user_id', $user)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $total['totalAmount'] = $cartItems->sum(
            function($item) {
                return $item->unit_price * $item->quantity;
            });


        $validatedData = $request->validate([
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


        // Toda a parte de stock precisa ser analisada com calma
        foreach ($cartItems as $cartItem)
        {
            $product = products::find($cartItem->product_id);

            if (!$product){
                return response()->json([
                    'message' => 'Product not found', 404,
                ]);
            }

            if($cartItem->quantity > $product->stock)
            {
                return response()->json([
                    'message' => 'Product stock is not enough: ' . $product->name,
                    'product_id' => $product->id,
                ], 400);
            }

            $product->stock -= $cartItem->quantity;
            $product->save();
        }

        if (!empty($validatedData['cupon_id'])) {
            $coupon = Coupons::find($validatedData['cupon_id']);

            if ($coupon) {
                $couponDiscount = $coupon->discount;
                $discountValue = $total['totalAmount'] * $couponDiscount;
                $total['totalAmount'] -= $discountValue;
                $validatedData['totalAmount'] = $total['totalAmount'];
            }
        }

        $Order = $this->ordersRepository->create($validatedData);

        if ($validatedData)
        $orderItemService->createFromCart($Order->id, $cartItems);

        return response ()->json([
            'message' => 'Order created with success',
            'data' => $Order
        ], 201);
    }

    public function specificOrders($order_id)
    {
        $user = auth()->user()->id;
        $order = Orders::where('id', $order_id)->where('user_id', $user)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        return response()->json(['order' => $order]);
    }

    public function updateOrders($request, $order_id)
    {
        $user = auth()->user()->role;

        $order = Orders::find($order_id);
        if (!$order)
        {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        if ($user != 'Moderator' && $user != 'Admin')
        {
            return response()->json([
                'message' => 'Only moderators can update orders'
            ]);
        }

        $validatedData = $request->validate([
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
        $order = Orders::where('id', $order_id)->where('user_id', $user)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        OrderItems::where('order_id', $order->id)->delete();
        $order->delete();
        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}
