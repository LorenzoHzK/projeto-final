<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {}

    public function register ()
    {
        return $this->userService->registerUser();
    }

    public function login ()
    {
        return $this->userService->loginUser();
    }

    public function logout ()
    {
        return $this->userService->logout();
    }

    public function renewToken()
    {
        return $this->userService->renewToken();
    }

    public function verifyToken()
    {
        return $this->userService->verifyToken();
    }

    public function infoUser()
    {
        return $this->userService->infoUser();
    }

    public function updateUser()
    {
        return $this->userService->updateUser();
    }

    public function deleteUser()
    {
        return $this->userService->deleteUser();
    }

    public function createModerator()
    {
        return $this->userService->createModerator();
    }
}
