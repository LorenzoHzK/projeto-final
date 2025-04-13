<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoriesService;

class CategoriesController extends Controller
{
    protected $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function createCategories(Request $request)
    {
        return $this->categoriesService->createCategories($request);
    }

    public function showCategories(string $id = null)
    {
        return $this->categoriesService->showCategories($id);
    }

    public function updateCategory(Request $request, string $id)
    {
        return $this->categoriesService->updateCategory($request, $id);
    }

    public function deleteCategory(string $id)
    {
        return $this->categoriesService->deleteCategory($id);
    }

    public function categoriesByUser(string $id_user = null)
    {
        return $this->categoriesService->categoriesByUser($id_user);
    }
}
