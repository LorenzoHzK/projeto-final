<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function register(Request $request)
    {
            $request->validate([
            "email" => "required|string|email|unique:users",
            "name" => "required|string|min:3",
            "password" => "required|string|min:8"
        ]);

        $user = User::create([
            "email" => $request->email,
            "name" => $request->name,
            "password" => Hash::make($request->password)
        ]);

        return response()->json([
            "message" => "User created successfully",
            "user" => $user
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth :: attempt($credentials)) {
            $user = $request->user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "access_token" => $token,
                "token_type" => "Bearer"
            ]);
        }

        return response()->json([
            "message" => "Invalid email or password"
        ]);
    }
}
