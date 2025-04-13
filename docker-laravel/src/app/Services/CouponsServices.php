<?php

namespace App\Services;

use App\Models\Coupons;
use Illuminate\Http\Request;
use App\Repositories\CouponsRepository;

class CouponsServices
{
    protected $couponsRepository;

    public function __construct(CouponsRepository $couponsRepository)
    {
        $this->couponsRepository = $couponsRepository;
    }

    public function createCoupons(Request $request)
    {
        if (!auth()->user() || auth()->user()->role !== 'Admin') {
            return response()->json([
                'message' => 'Apenas administradores podem criar categorias'
            ], 403);
        }

        $validatedData = $request->validate([
            'code' =>'required|string|min:3|max:255|unique:coupons,code',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required|decimal'
        ]);

        $validatedData['created_by'] = auth()->id();

        $coupons = $this->couponsRepository->create($validatedData);

        return response()->json([
            'message' => 'Categoria criada com sucesso',
            'data' => $coupons
        ], 201);
    }

    public function showCoupons($id = null)
    {
        if ($id) {
            $coupons = Coupons::find($id);
            return response()->json(['coupons' => $coupons]);
        } else {
            $coupons = Coupons::all();
            return response()->json(['coupons' => $coupons]);
        }
    }

    public function deleteCoupons(string $id)
    {
        $coupons = Coupons::find($id);
        $coupons->delete();
        return response()->json([
            'message' => 'Coupons deleted successfully',
        ]);
    }

    public function updateCoupons(Request $request, string $id)
    {
        $coupons = Coupons::find($id);

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        $coupons->update($validated);

        return response()->json([
            "message" => "Coupon updated successfully",
            "coupons" => $coupons
        ]);
    }
}
