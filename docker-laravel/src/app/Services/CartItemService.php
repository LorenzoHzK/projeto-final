<?php

namespace app\Services;

use App\Models\CartItem;
use App\Repositories\CartItemRepository;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartItemService
{
    public function __construct(
        protected CartItemRepository $cartItemRepository,
        protected Request $request)
    {}

    public function showItems()
    {
            $cartsItem = CartItem::all();
            return response()->json([
                'Cart' => $cartsItem
            ]);
    }

    public function createCartItem()
    {
        $userId = auth()->id();
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }


        $validatedData = $this->request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($validatedData['product_id']);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $existingCartItem = CartItem::where('product_id', $validatedData['product_id'])
            ->where('cart_id', $cart->id)
            ->first();

        if ($existingCartItem) {
            return $this->existingItem($existingCartItem, $validatedData['quantity'], $product);
        }

        if(!$product){
            return response()->json([
                'message' => 'Product not found',
            ]);
        }

            if($validatedData['quantity'] > $product->stock) {
                return response()->json([
                    'message' => 'Product stock is not enough: ' . $product->name,
                    'product_id' => $product->id,
                ], 400);
            }


        $validatedData['unit_price'] = $product->price;
        $validatedData['cart_id'] = $cart->id;

        $cartItem = $this->cartItemRepository->create($validatedData);

        return response()->json([
            'message' => 'Item added successfully',
            'cart_item' => $cartItem
        ]);
    }

    public function existingItem($existingCartItem, $additionalQuantity, $product)
    {
        $newQuantity = $existingCartItem->quantity + $additionalQuantity;

        if ($newQuantity > $product->stock) {
            return response()->json([
                'message' => 'Insufficient stock for product: ' . $product->name,
                'available_stock' => $product->stock,
            ], 400);
        }

        $existingCartItem->update([
            'quantity' => $newQuantity,
        ]);

        return response()->json([
            'message' => 'Product quantity updated successfully!',
            'cart_item' => $existingCartItem,
        ], 200);
    }

    public function updateCartItem()
    {
        $validatedData = $this->request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $updatedItem = $this->cartItemRepository->update($validatedData);

        return response()->json([
            "message" => "Item updated.",
            'items' => $updatedItem,
        ]);
    }


    public function deleteCartItem()
    {
        $validatedData = $this->request->validate([
            'product_id' => 'required|exists:products,id',
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
