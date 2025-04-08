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

    public function index()
    {
        return $this->userService->getAllUsers();
    }

    public function show($id)
    {
        return $this->userService->getUserById($id);
    }

    public function register (Request $request)
    {
        return $this->userService->registerUser($request);
    }

    public function login (Request $request)
    {
        return $this->userService->loginUser($request);
    }

    public function renewToken(Request $request)
    {
        return $this->userService->renewToken($request);
    }

    public function verifyToken(Request $request)
    {
        return $this->userService->verifyToken($request);
    }
}
