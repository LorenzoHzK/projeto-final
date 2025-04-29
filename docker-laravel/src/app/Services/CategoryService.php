<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected Request $request)
    {}

    public function createCategory()
    {
        $validatedData = $this->request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        if (Category::where('name', $validatedData['name'])->exists()) {
            return response()->json([
                'message' => 'Category with this name already exists'
            ]);
        }

        $validatedData['created_by'] = auth()->id();

        $category = $this->categoryRepository->create($validatedData);

        return response()->json([
            'message' => 'Category created with success',
            'data' => $category
        ], 201);
    }

    public function showCategories($id = null)
    {
        if ($id) {
            $category = $this->categoryRepository->find($id);
            return response()->json(['category' => $category]);
        } else {
            $categories = $this->categoryRepository->all();
            return response()->json(['category' => $categories]);
        }
    }

    public function deleteCategory(string $id)
    {
        if(!Category::where('id', $id)->exists()){
            return response()->json(['message' => 'Category not found',]);
        }

        $deleted = $this->categoryRepository->delete($id);

        if(!$deleted){
            return response()->json(['message' => 'Category not found',]);
        }

        return response()->json([
            'message' => 'Category deleted successfully' . $deleted,
        ]);
    }

    public function updateCategory(string $id)
    {
        $validated = $this->request->validate([
            'name' => 'required|string|min:3|max:255|unique:categories,name,',
            'description' => 'nullable|string|max:500'
        ]);

        $category = $this->categoryRepository->update($id, $validated);

        return response()->json([
            "message" => "Category updated successfully",
            "category" => $category
        ]);
    }

    public function categoriesByUser($id_user = null)
    {
        if(!$id_user){
          return response()->json(['message' => 'User id Required']);
        }

        $categories = $this->categoryRepository->getByUserId($id_user);

        if (!$categories->isEmpty()){
            return response()->json(['message' => $categories]);
        } else {
            return response()->json(['category' => 'The user not exists the category lined']);
        }
    }
}
