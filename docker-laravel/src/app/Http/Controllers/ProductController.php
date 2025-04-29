<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {}

    public function showProducts($id = null)
    {
        return $this->productService->showProducts($id);
    }

    public function createProducts()
    {
        return $this->productService->createProducts();
    }

    public function uploadImage($product_id)
    {
        return $this->productService->uploadImage($product_id);
    }

    public function showImage($product_id)
    {
        return $this->productService->showImage($product_id);
    }


    public function productsByCategory($category_id = null)
    {
        return $this->productService->productsByCategory($category_id);
    }

    public function updateProducts(String $id)
    {
        return $this->productService->updateProducts($id);
    }

    public function deleteProducts(string $id)
    {
        return $this->productService->deleteProducts($id);
    }

    public function updateStock(string $id)
    {
        return $this->productService->updateStock($id);
    }
}
