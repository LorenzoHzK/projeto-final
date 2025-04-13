<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;

// AUTENTICACAO - Rotas para o login e registro do usuário -
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
route::middleware('auth:sanctum')->post('/renew/token', [UserController::class, 'renewToken']);
route::middleware('auth:sanctum')->get('/verify/token', [UserController::class, 'verifyToken']);

//Rotas para o User
Route::middleware('auth:sanctum')->get('/user/me', [UserController::class, 'info_user']);
Route::middleware('auth:sanctum')->put('/user/me', [UserController::class, 'update_user']);
Route::middleware('auth:sanctum')->delete('/user/me', [UserController::class, 'delete_user']);
Route::middleware('auth:sanctum')->post('/user/create/moderator', [UserController::class, 'create_moderator']);


// Rotas para o address
Route::middleware('auth:sanctum')->get('/address/{id?}', [AddressController::class, 'showAddress']);
Route::middleware('auth:sanctum')->post('/address', [AddressController::class, 'createAddress']);
Route::middleware('auth:sanctum')->delete('/address/{id}', [AddressController::class, 'deleteAddress']);
Route::middleware('auth:sanctum')->put('/address/{id}', [AddressController::class, 'updateAddress']);
