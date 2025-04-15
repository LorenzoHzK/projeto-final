<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscountService;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function createDiscount(Request $request)
    {
        return $this->discountService->createDiscount($request);
    }

    public function showDiscount($id = null)
    {
        return $this->discountService->showDiscount($id);
    }

    public function deleteDiscount(string $id)
    {
        return $this->discountService->deleteDiscount($id);
    }

    public function updateDiscount(Request $request, String $id)
    {
        return $this->discountService->updateDiscount($request, $id);
    }
}
