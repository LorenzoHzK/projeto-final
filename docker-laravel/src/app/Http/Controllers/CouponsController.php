<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CouponService;

class CouponsController extends Controller
{
    protected $couponsServices;

    public function __construct(CouponService $couponsServices)
    {
        $this->couponsServices = $couponsServices;
    }

    public function showCoupons(string $id = null)
    {
        return $this->couponsServices->showCoupons($id);
    }

    public function createCoupons(Request $request)
    {
        return $this->couponsServices->createCoupons($request);
    }

    public function updateCoupons(Request $request, string $id)
    {
        return $this->couponsServices->updateCoupons($request, $id);
    }

    public function deleteCoupons(string $id)
    {
        return $this->couponsServices->deleteCoupons($id);
    }
}
