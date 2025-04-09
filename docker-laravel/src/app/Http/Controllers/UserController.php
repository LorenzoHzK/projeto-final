<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register (Request $request)
    {
        return $this->userService->registerUser($request);
    }

    public function login (Request $request)
    {
        return $this->userService->loginUser($request);
    }

    public function logout (Request $request)
    {
        return $this->userService->logout($request);
    }

    public function renewToken(Request $request)
    {
        return $this->userService->renewToken($request);
    }

    public function verifyToken(Request $request)
    {
        return $this->userService->verifyToken($request);
    }

    public function info_user()
    {
        return $this->userService->info_user();
    }

    public function update_user(Request $request)
    {
        return $this->userService->update_user($request);
    }

    public function delete_user()
    {
        return $this->userService->delete_user();
    }

    public function create_moderator(Request $request)
    {
        return $this->userService->create_moderator($request);
    }
}
