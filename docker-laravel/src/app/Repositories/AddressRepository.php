<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    protected $model;

    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
