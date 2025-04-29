<?php

namespace App\Repositories;

use App\Models\Coupon;

class CouponRepository
{
    public function __construct(protected Coupon $model) {}

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, $validated)
    {
        $coupon = $this->model->find($id);
        return $coupon->update($validated);
    }

    public function delete($id)
    {
        $coupon = $this->find($id);
        return $coupon->delete();
    }
}
