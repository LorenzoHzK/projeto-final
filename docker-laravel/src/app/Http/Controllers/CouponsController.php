<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupons::all();
        return response()->json($coupons);
    }

    public function store(Request $request)
    {
        $orders = Coupons::create([
            "code" => $request->code,
            "startDate" => $request->startDate,
            "endDate" => $request->endDate,
            "discount" => $request->discount
        ]);

        return response()->json([
            "message" => "Coupon created successfully",
            "coupons" => $orders
        ]);
    }

    public function show(string $id)
    {
        $orders = Coupons::findOrFail($id);
        return response()->json($orders);
    }

    public function update(Request $request, string $id)
    {
        $orders = Coupons::findOrFail($id);
        $orders->update([
            "startDate" => $request->startDate,
            "endDate" => $request->endDate,
            "discount" => $request->discount
        ]);

        return response()->json([
            "message" => "Coupon updated successfully",
            "coupons" => $orders
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
