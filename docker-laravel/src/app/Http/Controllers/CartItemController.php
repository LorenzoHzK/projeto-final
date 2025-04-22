<?php

namespace App\Http\Controllers;

use App\Services\CartItemService;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    protected CartItemService $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        return $this->cartItemService = $cartItemService;
    }

    public function cartItems()
    {
        return $this->cartItemService->showItems();
    }

    public function createCartItem(Request $request)
    {
        return $this->cartItemService->createCartItem($request);
    }

    public function updateCartItem(Request $request)
    {
        return $this->cartItemService->updateCartItem($request);
    }

    public function deleteCartItem(Request $request)
    {
        return $this->cartItemService->deleteCartItem($request);
    }
}
