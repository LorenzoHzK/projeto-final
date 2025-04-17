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

    public function createProducts(Request $request)
    {
        return $this->productsService->createProducts($request);
    }

    public function showProducts($id = null)
    {
        return $this->productsService->showProducts($id);
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
