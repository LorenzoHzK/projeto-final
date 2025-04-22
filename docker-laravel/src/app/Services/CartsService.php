<?php

namespace App\Services;

use App\Models\Carts;
use App\Repositories\CartsRepository;
use App\Models\CartItem;

class CartsService
{
    protected $cartsRepository;

    public function __construct(CartsRepository $cartsRepository)
    {
        $this->cartsRepository = $cartsRepository;
    }

    public function showCart($id = null)
    {
        if ($id) {
            $carts = Carts::find($id);
            return response()->json(['Carts' => $carts]);
        } else {
            $carts = Carts::all();
            return response()->json(['Carts' => $carts]);
        }
    }

    public function createCart()
    {
        $validatedData['user_id'] = auth()->id();

        if (Carts::where('user_id', $validatedData['user_id'])->exists()) {
            return response()->json([
                'message' => 'Carts with this user already exists'
            ], 409);
        }

        $carts = $this->cartsRepository->create($validatedData);

        return response()->json([
            'message' => 'Carts create with success',
            'data' => $carts
        ], 201);
    }

    public function clearCartItem()
    {
        $user = auth()->user()->id;
        $cart = Carts::where('user_id', $user)->first()->id;
        $data = CartItem::where('cart_id', $cart)->delete();

        return response()->json([
            'message' => 'Cart items deleted successfully',
            'cart items deleted' => $data
        ]);
    }
}
