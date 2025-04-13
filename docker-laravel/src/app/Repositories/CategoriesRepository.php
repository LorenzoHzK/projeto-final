<?php

namespace App\Repositories;

use App\Models\categories;

class CategoriesRepository
{
    public function all()
    {
        return Categories::all();
    }

    public function find($id)
    {
        return Categories::find($id);
    }

    public function create(array $data)
    {
        return Categories::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        return $category->update($data);
    }

    public function deleteCategories($id)
    {
        $category = $this->find($id);
        return $category->deleteCategories();
    }
}
