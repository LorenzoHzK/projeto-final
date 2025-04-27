<?php

namespace App\Http\Controllers;

use App\Services\CartItemService;

class CartItemController extends Controller
{
    public function __construct(protected CartItemService $cartItemService)
    {
        return $this->CartItemService = $cartItemService;
    }

    public function cartItems()
    {
        return $this->CartItemService->showItems();
    }

    public function createCartItem()
    {
        return $this->CartItemService->createCartItem();
    }

    public function updateCartItem()
    {
        return $this->CartItemService->updateCartItem();
    }

    public function deleteCartItem()
    {
        return $this->CartItemService->deleteCartItem();
    }
}
