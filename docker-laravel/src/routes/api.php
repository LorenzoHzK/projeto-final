<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;

//Rotas para o login e registro do usuário

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user/profile', function (Request $request) {
    return $request->user();
});
