<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{id}/token', function ($id) {
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    $token = $user->createToken('api_token')->plainTextToken;
    return response()->json(['token' => $token]);
});

Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/{shop}', [ShopController::class, 'show']);
Route::post('/shops', [ShopController::class, 'store']);
Route::put('/shops/{shop}', [ShopController::class, 'update']);
Route::delete('/shops/{shop}', [ShopController::class, 'destroy']);

Route::get('/products', [ProductController::class, 'sortBy']);
Route::get('/products', [ProductController::class, 'filterProducts']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);


Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{order}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::delete('/orders/{order}', [OrderController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
