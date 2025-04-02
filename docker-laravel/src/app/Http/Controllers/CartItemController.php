<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItem = CartItem::all();
        return response()->json($cartItem);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->integer('id');

            $table->unsignedBigInteger('cart_id')->unique();
            $table->foreign('cart_id')->references('id')->on('carts');

            $table->UnsignedInteger('product_id')->unique();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
        });
    }

    public function show(string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        return response()->json($cartItem);
    }

    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update($request->all());
        return response()->json($cartItem);
    }

    public function destroy(string $id)
    {
        //
    }
}
