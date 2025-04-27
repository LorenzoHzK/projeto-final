<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        $this->ProductService = $productService;
    }

    public function showProducts($id = null)
    {
        return $this->ProductService->showProducts($id);
    }

    public function createProducts()
    {
        return $this->ProductService->createProducts();
    }

    public function uploadImage($product_id)
    {
        return $this->ProductService->uploadImage($product_id);
    }

    public function showImage($product_id)
    {
        return $this->ProductService->showImage($product_id);
    }


    public function productsByCategory($category_id = null)
    {
        return $this->ProductService->productsByCategory($category_id);
    }

    public function updateProducts(String $id)
    {
        return $this->ProductService->updateProducts($id);
    }

    public function deleteProducts(string $id)
    {
        return $this->ProductService->deleteProducts($id);
    }

    public function updateStock(string $id)
    {
        return $this->ProductService->updateStock($id);
    }
}
