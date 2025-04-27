<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CouponService;

class CouponController extends Controller
{
    public function __construct(protected CouponService $couponsService)
    {
        $this->CouponService = $couponsService;
    }

    public function showCoupons(string $id = null)
    {
        return $this->CouponService->showCoupons($id);
    }

    public function createCoupons(Request $request)
    {
        return $this->CouponService->createCoupons($request);
    }

    public function updateCoupons(Request $request, string $id)
    {
        return $this->CouponService->updateCoupons($request, $id);
    }

    public function deleteCoupons(string $id)
    {
        return $this->CouponService->deleteCoupons($id);
    }
}
