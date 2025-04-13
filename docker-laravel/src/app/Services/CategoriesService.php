<?php

namespace App\Services;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Repositories\CategoriesRepository;

class CategoriesService
{
    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
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
            $category = Categories::find($id);
            return response()->json(['category' => $category]);
        } else {
            $categories = Categories::all();
            return response()->json(['categories' => $categories]);
        }
    }

    public function deleteCategory(string $id)
    {
        $category = Categories::find($id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }

    public function updateCategory(Request $request, string $id)
    {
        $category = Categories::find($id);

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
                'message' => 'erro, you can`t verify the categories, you must be an admin'
            ], 401);
        };

        if ($id_user){
            $create_by = $id_user;
            $category = Categories::find($create_by);
            return response()->json(['message' => $category]);
        } else {
            return response()->json(['categories' => 'The user not exists addresses linked']);
        }
    }
}
