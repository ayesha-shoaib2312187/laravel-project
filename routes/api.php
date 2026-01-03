<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (PUBLIC)
|--------------------------------------------------------------------------
| These routes do NOT require authentication
| Used to get Bearer Token
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| PUBLIC PRODUCT ROUTES
|--------------------------------------------------------------------------
| Anyone can view products (without login)
*/
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (AUTH REQUIRED)
|--------------------------------------------------------------------------
| These routes require Bearer Token via Sanctum
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);


    // Logged-in user info
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });



    /*
    |--------------------------------------------------------------------------
    | ORDER ROUTES (USER)
    |--------------------------------------------------------------------------
    | Users can place orders and view order history
    */
    Route::get('/orders', [OrderController::class, 'index']);     // order history
    Route::post('/orders', [OrderController::class, 'store']);    // place order
    Route::get('/orders/{id}', [OrderController::class, 'show']); // order details

    /*
    |--------------------------------------------------------------------------
    | PRODUCT CRUD (ADMIN)
    |--------------------------------------------------------------------------
    | In this project, admin is any authenticated user
    | (No role-based guard implemented yet)
    */
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});
