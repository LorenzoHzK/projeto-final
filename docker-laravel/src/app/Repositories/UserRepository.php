<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function find(int $id): ?User
    {
        return $this->model->find($id);
    }

    public function update(int $user, $userData): ?User
    {
        $user = $this->find($user);

        if (!$user) {
            return null;
        }

        $user->update($userData);
        return $user->fresh();
    }

    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);

        if (!$user) {
            return false;
        }
        return $user->delete();
    }
}
