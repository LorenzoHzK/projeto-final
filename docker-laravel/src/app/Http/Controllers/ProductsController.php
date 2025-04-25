<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productsService;

    public function __construct(productsService $productsService)
    {
        $this->productsService = $productsService;
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
