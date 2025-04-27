<?php

namespace App\Http\Controllers;

use App\Services\CartService;

class CartsController extends Controller
{
    protected CartService $cartsService;

    public function __construct(CartService $cartsService)
    {
        $this->cartsService = $cartsService;
    }


    public function showCart(string $id = null)
    {
        return $this->cartsService->showCart($id);
    }

    public function createCart()
    {
        return $this->cartsService->createCart();
    }

    public function cartItem()
    {
        return $this->cartsServices->cartItem();
    }

    public function clearCartItem()
    {
        return $this->cartsService->clearCartItem();
    {

    }
    }
}
