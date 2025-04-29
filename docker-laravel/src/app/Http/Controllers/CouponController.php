<?php

namespace App\Http\Controllers;

use App\Services\CouponService;

class CouponController extends Controller
{
    public function __construct(protected CouponService $couponsService)
    {}

    public function showCoupons(string $id = null)
    {
        return $this->couponsService->showCoupons($id);
    }

    public function createCoupons()
    {
        return $this->couponsService->createCoupons();
    }

    public function updateCoupons(string $id)
    {
        return $this->couponsService->updateCoupons($id);
    }

    public function deleteCoupons(string $id)
    {
        return $this->couponsService->deleteCoupons($id);
    }
}
