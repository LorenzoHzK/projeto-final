<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
        $this->UserService = $userService;
    }

    public function register ()
    {
        return $this->UserService->registerUser();
    }

    public function login ()
    {
        return $this->UserService->loginUser();
    }

    public function logout ()
    {
        return $this->UserService->logout();
    }

    public function renewToken()
    {
        return $this->UserService->renewToken();
    }

    public function verifyToken()
    {
        return $this->UserService->verifyToken();
    }

    public function infoUser()
    {
        return $this->UserService->infoUser();
    }

    public function updateUser()
    {
        return $this->UserService->updateUser();
    }

    public function deleteUser()
    {
        return $this->UserService->deleteUser();
    }

    public function createModerator()
    {
        return $this->UserService->createModerator();
    }
}
