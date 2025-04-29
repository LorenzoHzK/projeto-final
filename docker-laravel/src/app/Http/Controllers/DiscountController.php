<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;

class DiscountController extends Controller
{
    public function __construct(protected DiscountService $discountService)
    {}

    public function createDiscount()
    {
        return $this->discountService->createDiscount();
    }

    public function showDiscount($id = null)
    {
        return $this->discountService->showDiscount($id);
    }

    public function deleteDiscount(string $id)
    {
        return $this->discountService->deleteDiscount($id);
    }

    public function updateDiscount(String $id)
    {
        return $this->discountService->updateDiscount($id);
    }
}
