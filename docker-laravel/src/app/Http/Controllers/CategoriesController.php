<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $categories = Categories::create([
            "name" => $request->name,
            "description" => $request->description
        ]);

        return response()->json([
            "message" => "Category created successfully",
            "categories" => $categories
        ]);
    }

    public function show(string $id)
    {
        $categories = Categories::findOrFail($id);
        return response()->json($categories);
    }

    public function update(Request $request, string $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->update([
            "name" => $request->name,
            "description" => $request->description
        ]);

        return response()->json([
            "message" => "Category updated successfully",
            "categories" => $categories
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
