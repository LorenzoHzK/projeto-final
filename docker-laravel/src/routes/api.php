<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;

// AUTENTICACAO - Rotas para o login e registro do usuário -
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
route::middleware('auth:sanctum')->post('/renew/token', [UserController::class, 'renewToken']);
route::middleware('auth:sanctum')->get('/verify/token', [UserController::class, 'verifyToken']);

//Rotas para o User
Route::middleware('auth:sanctum')->get('/user/me', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/user/me', [UserController::class, 'update']);
