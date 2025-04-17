<?php

 namespace App\Services;

 use App\Models\products;
 use App\Repositories\ProductsRepository;
 use Illuminate\Http\Request;

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
 }
