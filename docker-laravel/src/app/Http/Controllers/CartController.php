<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartController extends Controller
{

    public function __construct(protected CartService $cartService)
    {
        $this->CartService = $cartService;
    }


    public function showCart(string $id = null)
    {
        return $this->CartService->showCart($id);
    }

    public function createCart()
    {
        return $this->CartService->createCart();
    }

    public function cartItem()
    {
        return $this->CartService->cartItem();
    }

    public function clearCartItem()
    {
        return $this->CartService->clearCartItem();
    {

    }
    }
}
