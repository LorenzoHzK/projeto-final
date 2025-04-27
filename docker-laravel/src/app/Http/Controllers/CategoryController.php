<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoriesService)
    {
        $this->CategoryService = $categoriesService;
    }

    public function createCategories()
    {
        return $this->CategoryService->createCategories();
    }

    public function showCategories(string $id = null)
    {
        return $this->CategoryService->showCategories($id);
    }

    public function updateCategory(string $id)
    {
        return $this->CategoryService->updateCategory($id);
    }

    public function deleteCategory(string $id)
    {
        return $this->CategoryService->deleteCategory($id);
    }

    public function categoriesByUser(string $id_user = null)
    {
        return $this->CategoryService->categoriesByUser($id_user);
    }
}
