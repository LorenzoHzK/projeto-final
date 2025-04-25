<?php

 namespace App\Services;

 use App\Models\categories;
 use App\Models\products;
 use App\Repositories\ProductsRepository;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Storage;

 class ProductsService
 {

     protected $productsRepository;

     public function __construct(ProductsRepository $productsRepository)
     {
         $this->productsRepository = $productsRepository;
     }

     public function createProducts(Request $request)
     {
         if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
             return response()->json([
                 'message' => 'Just Moderators can create a product'
             ], 403);
         }

         $validatedData = $request->validate([
            'category_id' => 'required|integer',
             'name' => 'required|string|min:3|max:255',
             'stock' => 'required|integer',
             'price' => 'required'
         ]);

         if (Products::where('name', $validatedData['name'])->exists()) {
             return response()->json([
                 'message' => 'Product with this name already exists'
             ], 409);
         }

         if (!Categories::where('id', $validatedData['category_id'])->exists())
         {
             return response()->json([
                 'message' => 'Category not found'
             ]);
         }

         $validatedData = $this->productsRepository->create($validatedData);

         return response()->json([
             'message' => 'Product created with success',
             'data' => $validatedData
         ], 201);
     }

     public function showProducts($id = null)
     {
         if ($id) {
             $product = Products::find($id);
             return response()->json(['Product' => $product]);
         }
         elseif ($id == null){
             $product = Products::all();
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
            $product = Products::find($category_id);
            return response()->json(['Product' => $product]);
        }
        else{
            return response()->json(['message' => 'Product not found']);
        }
     }


     public function updateProducts(Request $request, string $id)
     {
         if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
             return response()->json([
                 'message' => 'Just Moderators can update the stock of a product'
             ], 403);
         }

         if (!$products = Products::findOrFail($id)) {
             return response()->json([
                 'message' => 'Product not found'
             ], 404);
         }

         $products->update([
             "category_id" => $request->category_id,
             "name" => $request->name,
             "price" => $request->price
         ]);

         return response()->json([
             "message" => "Product updated successfully",
             "products" => $products
         ]);
     }


     public function deleteProducts($id)
     {
         if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
             return response()->json([
                 'message' => 'Just Moderators can update the stock of a product'
             ], 403);
         }

         $products = Products::find($id);
         $products->delete();
         return response()->json([
             'message' => 'Product deleted successfully',
         ]);
     }

    public function updateStock(string $id, $request)
    {
        if (auth()->user()->role !== 'Admin' && auth()->user()->role !== 'Moderator') {
            return response()->json([
                'message' => 'Just Moderators can update the stock of a product'
            ], 403);
        }

        if (!$products = Products::findOrFail($id)) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $products->update([
            "stock" => $request->stock,
        ]);

        return response()->json([
            "message" => "Stock at this product updated successfully",
            "products" => $products
        ]);
    }

     public function uploadImage(Request $request, $product_id)
     {
         $product = $this->productsRepository->find($product_id);

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }

         if ($request->hasFile('image_path')) {
             $path = $request->file('image_path')->store('products', 'public');

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
         $product = $this->productsRepository->find($product_id);

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
