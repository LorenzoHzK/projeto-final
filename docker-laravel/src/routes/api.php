<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrdersController;

// Authentication - Route to o login and register of user
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/renew/token', [UserController::class, 'renewToken']);
    Route::get('/verify/token', [UserController::class, 'verifyToken']);

    //Route to User
    Route::prefix('user')->group(function () {
    Route::get('/me', [UserController::class, 'info_user']);
    Route::put('/me', [UserController::class, 'update_user']);
    Route::delete('/me', [UserController::class, 'delete_user']);
    Route::post('/create/moderator', [UserController::class, 'create_moderator']);
    });

    // Route to address
    Route::prefix('address')->group(function () {
    Route::get('/{id?}', [AddressController::class, 'showAddress']);
    Route::post('/', [AddressController::class, 'createAddress']);
    Route::delete('/{id}', [AddressController::class, 'deleteAddress']);
    Route::put('/{id}', [AddressController::class, 'updateAddress']);
    });

    // Route for Categories
    Route::prefix('category')->group(function () {
    Route::get('/{id?}', [CategoriesController::class, 'showCategories'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/', [CategoriesController::class, 'createCategories']);
    Route::delete('/{id}', [CategoriesController::class, 'deleteCategory']);
    Route::put('/{id}', [CategoriesController::class, 'updateCategory']);
    Route::get('/user/{user_id}', [CategoriesController::class, 'categoriesByUser']);
    });

    // Route to Coupon
    Route::prefix('coupon')->group(function () {
    Route::get('/{id?}', [CouponsController::class, 'showCoupons']);
    Route::post('/', [CouponsController::class, 'createCoupons']);
    Route::delete('/{id}', [CouponsController::class, 'deleteCoupons']);
    Route::put('/{id}', [CouponsController::class, 'updateCoupons']);
    });

    // Route to Discounts
    Route::prefix('discount')->group(function () {
    Route::get('/{id?}', [DiscountController::class, 'showDiscount']);
    Route::post('/', [DiscountController::class, 'createDiscount']);
    Route::delete('/{id}', [DiscountController::class, 'deleteDiscount']);
    Route::put('/{id}', [DiscountController::class, 'updateDiscount']);
    });

    //Route to Products
    Route::post('/image/product/{product_id}', [ProductsController::class, 'uploadImage']);
    Route::get('/image/product/{product_id}', [ProductsController::class, 'showImage']);

    Route::prefix('product')->group(function () {
    Route::get('/{id?}', [ProductsController::class, 'showProducts']);
    Route::get('/category/{category_id}', [ProductsController::class, 'productsByCategory']);
    Route::post('/', [ProductsController::class, 'createProducts']);
    Route::put('/{id?}', [ProductsController::class, 'updateProducts']);
    Route::delete('/{id?}', [ProductsController::class, 'deleteProducts']);
    Route::delete('/{id?}/stock', [ProductsController::class, 'updateStock']);
    });

// Route to Cart
    Route::prefix('cart')->group(function () {
    Route::get('/', [CartsController::class, 'showCart']);
    Route::post('/', [CartsController::class, 'createCart']);

// Route to CartItem
    Route::get('/items', [CartItemController::class, 'cartItems']);
    Route::put('/items', [CartItemController::class, 'updateCartItem']);
    Route::post('/items', [CartItemController::class, 'createCartItem']);
    Route::delete('/items', [CartItemController::class, 'deleteCartItem']);

// Route to clean the CartItem
    Route::delete('/clear', [CartsController::class, 'clearCartItem']);
});

//Route to orders
    Route::prefix('order')->group(function () {
    Route::get('/', [OrdersController::class, 'showOrders']);
    Route::post('/', [OrdersController::class, 'createOrders']);
    Route::get('/{order_id}', [OrdersController::class, 'specificOrders']);
    Route::put('/{order_id}', [OrdersController::class, 'updateOrders']);
    Route::delete('/{id}', [OrdersController::class, 'deleteOrders']);
    });
});
