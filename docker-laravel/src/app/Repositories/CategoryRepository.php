<?php

namespace App\Repositories;

use App\Models\category;

class CategoryRepository
{
    public function all()
    {
        return category::all();
    }

    public function find($id)
    {
        return category::find($id);
    }

    public function create(array $data)
    {
        return category::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        return $category->update($data);
    }

    public function deleteCategories($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
