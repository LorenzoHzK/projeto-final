<?php


namespace App\Services;

use App\Models\discount;
use App\Models\product;
use Illuminate\Http\Request;
use App\Repositories\DiscountRepository;

class DiscountService
{
    public function __construct(protected DiscountRepository $discountRepository, Request $request)
    {
        $this->DiscountRepository = $discountRepository;
        $this->request = $request;
    }

    public function createDiscount()
    {
        if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
            return response()->json([
                'message' => 'Just Admins can create discount'
            ], 403);
        }

        $validatedData = $this->request->validate([
            'description' => 'required|string|min:3|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required|numeric|min:0|max:100',
            'product_id' => 'required|integer',
        ]);

        $validatedData['discount'] = $validatedData['discount'] / 100;
        $product = product::find($validatedData['product_id']);
        if ($product)
        {
            $discountValue = $product->price * $validatedData['discount'];
            $product->update([
                'price' => $product->price - $discountValue,
            ]);
        }
        else{
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $discount = $this->discountRepository->create($validatedData);

        return response()->json([
            'message' => 'discount created with success',
            'data' => $discount
        ], 201);
    }

    public function showDiscount($id = null)
    {
        if ($id) {
            $discount = Discount::find($id);
            return response()->json(['Discount' => $discount]);
        }
        else{
            $discount = Discount::all();
            return response()->json(['Discount' => $discount]);
        }
    }

    public function deleteDiscount(string $id)
    {
        $discount = Discount::find($id);
        $discount->delete();
        return response()->json([
            'message' => 'Discount deleted successfully',
        ]);
    }

    public function updateDiscount(string $id)
    {
        $discount = Discount::find($id);

        $validated = $this->request->validate([
            'description' => 'required|string|min:3|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required'
        ]);

        $discount->update($validated);

        return response()->json([
            "message" => "Discount updated successfully",
            "discount" => $discount
        ]);
    }
}
