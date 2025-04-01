<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\address;
use App\Models\orders;


Route::post("/register", function(Request $request){
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
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth :: attempt($credentials)) {
        $user = $request->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "acess_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    return response()->json([
        "message" => "Invalid email or password"
    ]);

});

Route::middleware('auth:sanctum')->get('/user/profile', function (Request $request) {
    return $request->user();
});
