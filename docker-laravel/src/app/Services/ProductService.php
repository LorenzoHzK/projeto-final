<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected Request $request)
    {}

    public function createProducts()
    {
        $validatedData = $this->request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|min:3|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|min:0',
            'original' => 'required|boolean',
            'weight' => 'required|min:1|max:255',
        ]);

        if (Product::where('name', $validatedData['name'])->exists()) {
            return response()->json([
                'message' => 'Product with this name already exists'
            ], 409);
        }

        if (!Category::where('id', $validatedData['category_id'])->exists()) {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }

        $this->productRepository->create($validatedData);

        return response()->json([
            'message' => 'Product created with success',
            'data' => $validatedData
        ], 201);
    }

    public function showProducts($id = null)
    {
        if ($id) {
            $product = $this->productRepository->find($id);
            if(!$product) {
                return response()->json(['message' => 'product not found']);
            }
            return response()->json(['Product' => $product]);
        }

        $products = Product::all();
        return response()->json(['Product' => $products]);
    }

    public function productsByCategory($category_id)
    {
        $products = Product::where('category_id', $category_id)->get();

        if ($products->isEmpty()){
            return response()->json(['message' => 'Product not found by category']);
        }

        return response()->json(['Product' => $products]);
    }


    public function updateProducts(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        $validatedData = $this->request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|min:0',
            'original' => 'required|boolean',
            'weight' => 'required|min:1|max:255',
        ]);

        if (!Category::where('id', $validatedData['category_id'])->exists()) {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }

        $this->productRepository->update($id, $validatedData);

        return response()->json([
            "message" => "Product updated successfully",
            "product" => $validatedData
        ]);
    }


    public function deleteProducts($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        $this->productRepository->delete($id);

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }

    public function updateStock(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        $validatedData = $this->request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $this->productRepository->update($id, $validatedData);

        return response()->json([
            "message" => "Stock at this product updated successfully",
        ]);
    }

    public function uploadImage($product_id)
    {
        $product = $this->productRepository->find($product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if ($this->request->hasFile('image_path')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $this->request->file('image_path')->store('product', 'public');

            $product->image = $path;
            $product->save();

            return response()->json([
                'message' => 'Product image uploaded successfully',
            ]);
        }

        return response()->json([
            'message' => 'No image was uploaded'
        ], 400);
    }

    public function showImage($product_id)
    {
        $product = $this->productRepository->find($product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if (!$product->image) {
            return response()->json(['message' => 'Product has no image'], 404);
        }

        $path = $product->image;

        if (!Storage::disk('public')->exists($path)) {
            return response()->json(['message' => 'Image file not found in storage'], 404);
        }

        return response(Storage::disk('public')->get($path), 200)
            ->header('Content-Type', Storage::disk('public')->mimeType($path));
    }
}
