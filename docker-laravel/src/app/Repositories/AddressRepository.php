<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddressRepository
{
    protected $model;

    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data): Address
    {
        return $this->model->create($data);
    }

    public function find(string $id): ?Address
    {
        return $this->model->find($id);
    }

    public function findOrFail(string $id): Address
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $validatedData, string $id): bool
    {
        $address = $this->findOrFail($id);
        return $address->update($validatedData);
    }

    public function delete(string $id): bool
    {
        $address = $this->findOrFail($id);
        return $address->delete();
    }
}
