<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Repositories\CouponRepository;

class CouponService
{
    public function __construct(protected CouponRepository $couponsRepository)
    {
        $this->CouponRepository = $couponsRepository;
    }

    public function showCoupons($id = null)
    {
        if ($id) {
            $coupons = Coupon::find($id);
            return response()->json(['coupons' => $coupons]);
        } else {
            $coupons = Coupon::all();
            return response()->json(['coupons' => $coupons]);
        }
    }

    public function createCoupons(Request $request)
    {
        if (!auth()->user() || auth()->user()->role !== 'Admin') {
            return response()->json([
                'message' => 'Just Admins can create coupons'
            ], 403);
        }

        $validatedData = $request->validate([
            'code' =>'required|string|min:3|max:255|unique:coupons',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required'
        ]);

        $validatedData['discount'] = $validatedData['discount'] / 100;

        $coupons = $this->couponsRepository->create($validatedData);

        return response()->json([
            'message' => 'Discount created with success',
            'data' => $coupons
        ], 201);
    }

    public function deleteCoupons(string $id)
    {
        $coupons = Coupon::find($id);
        $coupons->delete();
        return response()->json([
            'message' => 'Coupon deleted successfully',
        ]);
    }

    public function updateCoupons(Request $request, string $id)
    {
        $coupons = Coupon::find($id);

        $validated = $request->validate([
            'code' =>'required|string|min:3|max:255|unique:coupons',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'sometimes|required'
        ]);

        $coupons->update($validated);

        return response()->json([
            "message" => "Coupon updated successfully",
            "coupons" => $coupons
        ]);
    }
}
