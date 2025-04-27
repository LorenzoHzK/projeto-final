<?php

 namespace App\Services;

 use App\Models\category;
 use App\Models\product;
 use App\Repositories\ProductRepository;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Http\Request;

 class ProductService
 {
     public function __construct(protected ProductRepository $productsRepository, Request $request)
     {
         $this->ProductRepository = $productsRepository;
         $this->request = $request;
     }

     public function createProducts()
     {
         if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
             return response()->json([
                 'message' => 'Just Moderators can create a product'
             ], 403);
         }

         $validatedData = $this->request->validate([
            'category_id' => 'required|integer',
             'name' => 'required|string|min:3|max:255',
             'stock' => 'required|integer',
             'price' => 'required'
         ]);

         if (product::where('name', $validatedData['name'])->exists()) {
             return response()->json([
                 'message' => 'Product with this name already exists'
             ], 409);
         }

         if (!category::where('id', $validatedData['category_id'])->exists())
         {
             return response()->json([
                 'message' => 'Category not found'
             ]);
         }

         $validatedData = $this->ProductRepository->create($validatedData);

         return response()->json([
             'message' => 'Product created with success',
             'data' => $validatedData
         ], 201);
     }

     public function showProducts($id = null)
     {
         if ($id) {
             $product = product::find($id);
             return response()->json(['Product' => $product]);
         }
         elseif ($id == null){
             $product = product::all();
             return response()->json(['Products' => $product]);
         }
         else
         {
             return response()->json(['message' => 'Product not found']);
         }
     }

     public function productsByCategory($category_id)
     {
        if ($category_id){
            $product = product::find($category_id);
            return response()->json(['Product' => $product]);
        }
        else{
            return response()->json(['message' => 'Product not found']);
        }
     }


     public function updateProducts(string $id)
     {
         if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
             return response()->json([
                 'message' => 'Just Moderators can update the stock of a product'
             ], 403);
         }

         if (!$products = product::findOrFail($id)) {
             return response()->json([
                 'message' => 'Product not found'
             ], 404);
         }

         $products->update([
             "category_id" => $this->request->category_id,
             "name" => $this->request->name,
             "price" => $this->request->price
         ]);

         return response()->json([
             "message" => "Product updated successfully",
             "product" => $products
         ]);
     }


     public function deleteProducts($id)
     {
         if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
             return response()->json([
                 'message' => 'Just Moderators can update the stock of a product'
             ], 403);
         }

         $products = product::find($id);
         $products->delete();
         return response()->json([
             'message' => 'Product deleted successfully',
         ]);
     }

    public function updateStock(string $id)
    {
        if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
            return response()->json([
                'message' => 'Just Moderators can update the stock of a product'
            ], 403);
        }

        if (!$products = product::findOrFail($id)) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $products->update([
            "stock" => $this->request->stock,
        ]);

        return response()->json([
            "message" => "Stock at this product updated successfully",
            "product" => $products
        ]);
    }

     public function uploadImage($product_id)
     {
         $product = $this->ProductRepository->find($product_id);

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }

         if ($this->request->hasFile('image_path')) {
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
         $product = $this->ProductRepository->find($product_id);

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
