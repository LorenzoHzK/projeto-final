<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;

// Authentication - Route to o login and register of user
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/renew/token', [UserController::class, 'renewToken']);
    Route::get('/verify/token', [UserController::class, 'verifyToken']);

    //Route to User
    Route::prefix('user')->group(function () {
    Route::get('/me', [UserController::class, 'infoUser']);
    Route::put('/me', [UserController::class, 'updateUser']);
    Route::delete('/me', [UserController::class, 'deleteUser']);
    Route::post('/create/moderator', [UserController::class, 'createModerator']);
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
    Route::get('/{id?}', [CategoryController::class, 'showCategories'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/', [CategoryController::class, 'createCategories']);
    Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
    Route::put('/{id}', [CategoryController::class, 'updateCategory']);
    Route::get('/user/{user_id}', [CategoryController::class, 'categoriesByUser']);
    });

    // Route to Coupon
    Route::prefix('coupon')->group(function () {
    Route::get('/{id?}', [CouponController::class, 'showCoupons']);
    Route::post('/', [CouponController::class, 'createCoupons']);
    Route::delete('/{id}', [CouponController::class, 'deleteCoupons']);
    Route::put('/{id}', [CouponController::class, 'updateCoupons']);
    });

    // Route to Discounts
    Route::prefix('discount')->group(function () {
    Route::get('/{id?}', [DiscountController::class, 'showDiscount']);
    Route::post('/', [DiscountController::class, 'createDiscount']);
    Route::delete('/{id}', [DiscountController::class, 'deleteDiscount']);
    Route::put('/{id}', [DiscountController::class, 'updateDiscount']);
    });

    //Route to Products
    Route::post('/image/product/{product_id}', [ProductController::class, 'uploadImage']);
    Route::get('/image/product/{product_id}', [ProductController::class, 'showImage']);

    Route::prefix('product')->group(function () {
    Route::get('/{id?}', [ProductController::class, 'showProducts']);
    Route::get('/category/{category_id}', [ProductController::class, 'productsByCategory']);
    Route::post('/', [ProductController::class, 'createProducts']);
    Route::put('/{id?}', [ProductController::class, 'updateProducts']);
    Route::delete('/{id?}', [ProductController::class, 'deleteProducts']);
    Route::delete('/{id?}/stock', [ProductController::class, 'updateStock']);
    });

// Route to Cart
    Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'showCart']);
    Route::post('/', [CartController::class, 'createCart']);

// Route to CartItem
    Route::get('/items', [CartItemController::class, 'cartItems']);
    Route::put('/items', [CartItemController::class, 'updateCartItem']);
    Route::post('/items', [CartItemController::class, 'createCartItem']);
    Route::delete('/items', [CartItemController::class, 'deleteCartItem']);

// Route to clean the CartItem
    Route::delete('/clear', [CartController::class, 'clearCartItem']);
});

//Route to orders
    Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'showOrders']);
    Route::post('/', [OrderController::class, 'createOrders']);
    Route::get('/{order_id}', [OrderController::class, 'specificOrders']);
    Route::put('/{order_id}', [OrderController::class, 'updateOrders']);
    Route::delete('/{id}', [OrderController::class, 'deleteOrders']);
    });
});
