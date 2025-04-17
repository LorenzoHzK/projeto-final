<?php

namespace App\Repositories;
use App\Models\products;

class ProductsRepository
{
    protected $model;

    public function __construct(products $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
