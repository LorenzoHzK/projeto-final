<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\CartRepository;
use App\Models\CartItem;

class CartService
{
    protected $cartsRepository;

    public function __construct(CartRepository $cartsRepository)
    {
        $this->cartsRepository = $cartsRepository;
    }

    public function showCart($id = null)
    {
        if ($id) {
            $carts = Cart::find($id);
            return response()->json(['Cart' => $carts]);
        } else {
            $carts = Cart::all();
            return response()->json(['Cart' => $carts]);
        }
    }

    public function createCart()
    {
        $validatedData['user_id'] = auth()->id();

        if (Cart::where('user_id', $validatedData['user_id'])->exists()) {
            return response()->json([
                'message' => 'Cart with this user already exists'
            ], 409);
        }

        $carts = $this->cartsRepository->create($validatedData);

        return response()->json([
            'message' => 'Cart create with success',
            'data' => $carts
        ], 201);
    }

    public function clearCartItem()
    {
        $user = auth()->user()->id;
        $cart = Cart::where('user_id', $user)->first()->id;
        $data = CartItem::where('cart_id', $cart)->delete();

        return response()->json([
            'message' => 'Cart items deleted successfully',
            'cart items deleted' => $data
        ]);
    }
}
