<?php

namespace app\Services;

use App\Models\CartItem;
use App\Repositories\CartItemRepository;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\product;

class CartItemService
{
    protected $cartItemRepository;
    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function showItems()
    {
            $cartsItem = CartItem::all();
            return response()->json([
                'Cart' => $cartsItem
            ]);
    }

    public function createCartItem(Request $request)
    {
        $userId = auth()->id();
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['message' => 'Carrinho não encontrado.'], 404);
        }

        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = product::find($validatedData['product_id']);

            if($validatedData['quantity'] > $product->stock) {
                return response()->json([
                    'message' => 'Product stock is not enough: ' . $product->name,
                    'product_id' => $product->id,
                ], 400);
            }

        $product = product::findOrFail($validatedData['product_id']);

        $validatedData['unit_price'] = $product->price;
        $validatedData['cart_id'] = $cart->id;

        $cartItem = $this->cartItemRepository->create($validatedData);

        return response()->json([
            'message' => 'Item added with successful!',
            'cart_item' => $cartItem
        ]);
    }

    public function updateCartItem(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $validatedData = $this->cartItemRepository->update($validatedData);

        return response()->json([
            "message" => "Item updated successfully.",
            'product' => $validatedData->product_id,
            'quantity' => $validatedData->quantity,
        ]);
    }

    public function deleteCartItem(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
        ]);

        $productExists = CartItem::where('product_id', $validatedData['product_id'])->exists();
        if (!$productExists)
            {
                return response()->json([
                    'message' => 'Item not found',
                ]);
            }

        CartItem::where('product_id', $validatedData['product_id'])->delete();

        return response()->json([
            "Product " . $validatedData['product_id'] => "deleted successfully.",
        ]);
    }
}
