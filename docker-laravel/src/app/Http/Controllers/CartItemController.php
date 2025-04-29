<?php

namespace App\Http\Controllers;

use App\Services\CartItemService;

class CartItemController extends Controller
{
    public function __construct(protected CartItemService $cartItemService)
    {}

    public function ShowItems()
    {
        return $this->cartItemService->showItems();
    }

    public function createCartItem()
    {
        return $this->cartItemService->createCartItem();
    }

    public function updateCartItem()
    {
        return $this->cartItemService->updateCartItem();
    }

    public function deleteCartItem()
    {
        return $this->cartItemService->deleteCartItem();
    }
}
