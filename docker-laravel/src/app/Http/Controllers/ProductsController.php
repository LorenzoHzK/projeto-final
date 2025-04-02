<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $products = Products::create([
            "category_id" => $request->category_id,
            "name" => $request->name,
            "stock" => $request->stock,
            "price" => $request->price
        ]);

        return response()->json([
            "message" => "Product created successfully",
            "products" => $products
        ]);
    }

    public function show(string $id)
    {
        $products = Products::findOrFail($id);
        return response()->json($products);
    }

    public function update(Request $request, string $id)
    {
        $products = Products::findOrFail($id);
        $products->update([
            "category_id" => $request->category_id,
            "name" => $request->name,
            "stock" => $request->stock,
            "price" => $request->price
        ]);

        return response()->json([
            "message" => "Product updated successfully",
            "products" => $products
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
