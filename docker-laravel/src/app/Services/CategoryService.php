<?php

namespace App\Services;

use App\Models\category;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class CategoryService
{

    public function __construct(protected CategoryRepository $categoriesRepository)
    {
    }

    public function createCategories(Request $request)
    {
        if (!auth()->user() || auth()->user()->role !== 'Admin') {
            return response()->json([
                'message' => 'Apenas administradores podem criar categorias'
            ], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        $validatedData['created_by'] = auth()->id();

        $category = $this->categoriesRepository->create($validatedData);

        return response()->json([
            'message' => 'Categoria criada com sucesso',
            'data' => $category
        ], 201);
    }

    public function showCategories($id = null)
    {
        if ($id) {
            $category = category::find($id);
            return response()->json(['category' => $category]);
        } else {
            $categories = category::all();
            return response()->json(['category' => $categories]);
        }
    }

    public function deleteCategory(string $id)
    {
        $category = $this->categoriesRepository->deleteCategories($id);
        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }

    public function updateCategory(Request $request, string $id)
    {
        $category = category::find($id);

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        $category->update($validated);

        return response()->json([
            "message" => "Category updated successfully",
            "category" => $category
        ]);
    }

    public function categoriesByUser($id_user = null)
    {
        $user = auth()->user();

        if ($user->role != 'Admin') {
            return response()->json([
                'message' => 'erro, you can`t verify the category, you must be an admin'
            ], 401);
        };

        if ($id_user){
            $create_by = $id_user;
            $category = category::find($create_by);
            return response()->json(['message' => $category]);
        } else {
            return response()->json(['category' => 'The user not exists addresses linked']);
        }
    }
}
