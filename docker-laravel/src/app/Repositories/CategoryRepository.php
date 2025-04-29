<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function __construct(protected Category $model)
    {
        $this->Category = $model;
    }

    public function all()
    {
        return $this->Category->all();
    }

    public function find($id)
    {
        return $this->Category->find($id);
    }

    public function create(array $data)
    {
        return $this->Category->create($data);
    }

    public function update($id, array $validated)
    {
        $category = $this->Category->find($id);
        return $category->update($validated);
    }

    public function delete($id)
    {
        $category = $this->Category->find($id);
        return $category->delete();
    }

    public function getByUserId($id_user)
    {
        return $this->Category->where('created_by', $id_user)->get();
    }
}
