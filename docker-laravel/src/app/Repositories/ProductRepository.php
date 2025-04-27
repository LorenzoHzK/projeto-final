<?php
namespace App\Repositories;

use App\Models\product;

class ProductRepository
{
    protected $model;

    public function __construct(product $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function save($product)
    {
        return $product->save();
    }
}

