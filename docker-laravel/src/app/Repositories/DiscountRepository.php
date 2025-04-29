<?php

namespace App\Repositories;

use App\Models\Discount;

class DiscountRepository
{
    protected $model;

    public function __construct(Discount $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $validatedData)
    {
        $coupon = $this->find($id);
        return $coupon->update($validatedData);
    }

    public function delete($id)
    {
        $coupon = $this->find($id);
        return $coupon->delete();
    }
}
