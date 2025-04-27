<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;

class DiscountController extends Controller
{
    public function __construct(protected DiscountService $discountService)
    {
        $this->DiscountService = $discountService;
    }

    public function createDiscount()
    {
        return $this->DiscountService->createDiscount();
    }

    public function showDiscount($id = null)
    {
        return $this->DiscountService->showDiscount($id);
    }

    public function deleteDiscount(string $id)
    {
        return $this->DiscountService->deleteDiscount($id);
    }

    public function updateDiscount(String $id)
    {
        return $this->DiscountService->updateDiscount($id);
    }
}
