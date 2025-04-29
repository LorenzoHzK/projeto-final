<?php


namespace App\Services;

use App\Models\Discount;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\DiscountRepository;

class DiscountService
{
    public function __construct(
        protected DiscountRepository $discountRepository,
        protected Request $request)
    {}

    public function createDiscount()
    {
        $validatedData = $this->request->validate([
            'description' => 'required|string|min:3|max:255|unique:discounts',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required|numeric|min:0|max:100',
            'product_id' => 'required|integer',
        ]);

        if ($validatedData['endDate'] <= $validatedData['startDate']) {
            return response()->json(['message' => 'The end date must be greater than the start date']);
        }

        $validatedData['discount'] = $validatedData['discount'] / 100;

        if(!$product = Product::find($validatedData['product_id'])){
            return response()->json(['message' => 'Product not found']);
        }

            $discountValue = $product->price * $validatedData['discount'];
            $product->update([
                'price' => $product->price - $discountValue,
            ]);

        $discount = $this->discountRepository->create($validatedData);

        return response()->json([
            'message' => 'discount created with success',
            'data' => $discount
        ], 201);
    }

    public function showDiscount($id = null)
    {
        if ($id) {
            $discount = $this->discountRepository->find($id);
            return response()->json(['Discount' => $discount]);
        }
        else{
            $discount = $this->discountRepository->all();
            return response()->json(['Discount' => $discount]);
        }
    }

    public function deleteDiscount(string $id)
    {
        $discount = $this->discountRepository->find($id);

        if (!$discount) {
            return response()->json([
                'message' => 'Discount not found',
            ], 404);
        }

        $this->discountRepository->delete($id);

        return response()->json([
            'message' => 'Discount deleted successfully',
        ]);
    }

    public function updateDiscount(string $id)
    {
        $discount = $this->discountRepository->find($id);

        if (!$discount) {
            return response()->json([
                'message' => 'Discount not found',
            ], 404);
        }

        $validatedData = $this->request->validate([
            'description' => 'sometimes|string|min:3|max:255|unique:discounts',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'discount' => 'required'
        ]);

        if ($validatedData['endDate'] <= $validatedData['startDate']) {
            return response()->json(['message' => 'The end date must be greater than the start date']);
        }

        $validatedData['discount'] = $validatedData['discount'] / 100;

        $discount = $this->discountRepository->update($id, $validatedData);

        return response()->json([
            "message" => "Discount updated successfully",
            "discount" => $discount
        ]);
    }
}
