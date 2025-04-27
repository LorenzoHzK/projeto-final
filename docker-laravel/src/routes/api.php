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
    Route::get('/user/me', [UserController::class, 'info_user']);
    Route::put('/user/me', [UserController::class, 'update_user']);
    Route::delete('/user/me', [UserController::class, 'delete_user']);
    Route::post('/user/create/moderator', [UserController::class, 'create_moderator']);


    // Route to address
    Route::get('/address/{id?}', [AddressController::class, 'showAddress']);
    Route::post('/address', [AddressController::class, 'createAddress']);
    Route::delete('/address/{id}', [AddressController::class, 'deleteAddress']);
    Route::put('/address/{id}', [AddressController::class, 'updateAddress']);

    // Route for Categories
    Route::get('/category/{id?}', [CategoriesController::class, 'showCategories'])->withoutMiddleware(['auth:sanctum']);
    Route::post('/category', [CategoriesController::class, 'createCategories']);
    Route::delete('/category/{id}', [CategoriesController::class, 'deleteCategory']);
    Route::put('/category/{id}', [CategoriesController::class, 'updateCategory']);
    Route::get('/category/user/{user_id}', [CategoriesController::class, 'categoriesByUser']);

    // Route to Coupon
    Route::get('/coupon/{id?}', [CouponsController::class, 'showCoupons']);
    Route::post('/coupon', [CouponsController::class, 'createCoupons']);
    Route::delete('/coupon/{id}', [CouponsController::class, 'deleteCoupons']);
    Route::put('/coupon/{id}', [CouponsController::class, 'updateCoupons']);

    // Route to Discounts
    Route::get('/discount/{id?}', [DiscountController::class, 'showDiscount']);
    Route::post('/discount', [DiscountController::class, 'createDiscount']);
    Route::delete('/discount/{id}', [DiscountController::class, 'deleteDiscount']);
    Route::put('/discount/{id}', [DiscountController::class, 'updateDiscount']);

    //Route to Products
    Route::post('/image/product/{product_id}', [ProductsController::class, 'uploadImage']);
    Route::get('/image/product/{product_id}', [ProductsController::class, 'showImage']);

    Route::get('/product/{id?}', [ProductsController::class, 'showProducts']);
    Route::get('/product/category/{category_id}', [ProductsController::class, 'productsByCategory']);
    Route::post('/product', [ProductsController::class, 'createProducts']);
    Route::put('/product/{id?}', [ProductsController::class, 'updateProducts']);
    Route::delete('/product/{id?}', [ProductsController::class, 'deleteProducts']);
    Route::delete('/product/{id?}/stock', [ProductsController::class, 'updateStock']);

// Route to Cart
    Route::get('/cart/', [CartsController::class, 'showCart']);
    Route::post('/cart/', [CartsController::class, 'createCart']);

// Route to CartItem
    Route::get('/cart/items', [CartItemController::class, 'cartItems']);
    Route::put('/cart/items', [CartItemController::class, 'updateCartItem']);
    Route::post('/cart/items', [CartItemController::class, 'createCartItem']);
    Route::delete('/cart/items', [CartItemController::class, 'deleteCartItem']);

// Route to clean the CartItem
    Route::delete('/cart/clear', [CartsController::class, 'clearCartItem']);

//Route to orders
    Route::get('/orders', [OrdersController::class, 'showOrders']);
    Route::post('/orders', [OrdersController::class, 'createOrders']);
    Route::get('/orders/{order_id}', [OrdersController::class, 'specificOrders']);
    Route::put('/orders/{order_id}', [OrdersController::class, 'updateOrders']);
    Route::delete('/orders/{id}', [OrdersController::class, 'deleteOrders']);
});

