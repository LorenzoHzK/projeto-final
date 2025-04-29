<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\CouponRepository;

class CouponService
{
    public function __construct(
        protected CouponRepository $couponRepository,
        protected Request $request)
    {}

    public function showCoupons($id = null)
    {
        if ($id) {
            $coupons = $this->couponRepository->find($id);
            return response()->json(['coupons' => $coupons]);
        } else {
            $coupons = $this->couponRepository->all();
            return response()->json(['coupons' => $coupons]);
        }
    }

    public function createCoupons()
    {
        $validatedData = $this->request->validate([
            'code' =>'required|string|min:3|max:255|unique:coupons',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required'
        ]);

        $validatedData['discount'] = $validatedData['discount'] / 100;

        $coupons = $this->couponRepository->create($validatedData);

        return response()->json([
            'message' => 'Discount created with success',
            'data' => $coupons
        ], 201);
    }

    public function deleteCoupons(string $id)
    {
        if ($id == null) {
            return response()->json([
                'message' => 'Coupon not found',
            ]);
        }

        $this->couponRepository->delete($id);

        return response()->json([
            'message' => 'Coupon deleted successfully',
        ]);
    }

    public function updateCoupons(string $id)
    {
        $coupons = $this->couponRepository->find($id);

        $validated = $this->request->validate([
            'code' =>'required|string|min:3|max:255|unique:coupons',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'sometimes|required'
        ]);

        $validated['discount'] = $validated['discount'] / 100;

        $this->couponRepository->update($id, $validated);

        return response()->json([
            "message" => "Coupon updated successfully",
            "coupons" => $coupons
        ]);
    }
}
