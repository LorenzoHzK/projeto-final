<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\DiscountController;

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

// Rotas para Categories
Route::middleware('auth:sanctum')->get('/categories/{id?}', [CategoriesController::class, 'showCategories']);
Route::middleware('auth:sanctum')->post('/categories', [CategoriesController::class, 'createCategories']);
Route::middleware('auth:sanctum')->delete('/categories/{id}', [CategoriesController::class, 'deleteCategory']);
Route::middleware('auth:sanctum')->put('/categories/{id}', [CategoriesController::class, 'updateCategory']);
Route::middleware('auth:sanctum')->get('/categories/user/{user_id}', [CategoriesController::class, 'categoriesByUser']);

// Rotas para Coupons
Route::middleware('auth:sanctum')->get('/coupon/{id?}', [CouponsController::class, 'showCoupons']);
Route::middleware('auth:sanctum')->post('/coupon', [CouponsController::class, 'createCoupons']);
Route::middleware('auth:sanctum')->delete('/coupon/{id}', [CouponsController::class, 'deleteCoupons']);
Route::middleware('auth:sanctum')->put('/coupon/{id}', [CouponsController::class, 'updateCoupons']);

// Rotas para Discounts
Route::middleware('auth:sanctum')->get('/discount/{id?}', [DiscountController::class, 'showDiscount']);
Route::middleware('auth:sanctum')->post('/discount', [DiscountController::class, 'createDiscount']);
Route::middleware('auth:sanctum')->delete('/discount/{id}', [DiscountController::class, 'deleteDiscount']);
Route::middleware('auth:sanctum')->put('/discount/{id}', [DiscountController::class, 'updateDiscount']);
