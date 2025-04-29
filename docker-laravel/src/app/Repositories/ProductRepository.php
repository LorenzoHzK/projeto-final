<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function __construct(protected Product $model)
    {}

    public function create($validatedData)
    {
        return $this->model->create($validatedData);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $validatedData)
    {
        $product = $this->find($id);
        return $product->update($validatedData);
    }

    public function save($product)
    {
        return $product->save();
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();
    }
}

