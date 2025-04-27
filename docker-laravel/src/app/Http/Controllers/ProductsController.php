<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function createProducts(Request $request)
    {
        return $this->productService->createProducts($request);
    }

    public function uploadImage(Request $request, $product_id)
    {
        return $this->productsService->uploadImage($request, $product_id);
    }

    public function showImage($product_id)
    {
        return $this->productsService->showImage($product_id);
    }


    public function productsByCategory($category_id = null)
    {
        return $this->productsService->productsByCategory($category_id);
    }

    public function updateProducts(Request $request, String $id)
    {
        return $this->productsService->updateProducts($request, $id);
    }

    public function deleteProducts(string $id)
    {
        return $this->productsService->deleteProducts($id);
    }

    public function updateStock(string $id, Request $request)
    {
        return $this->productsService->updateStock($id, $request);
    }
}
