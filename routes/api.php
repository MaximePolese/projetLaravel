<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
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

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);

Route::get('/carts', [CartController::class, 'index']);
Route::get('/carts/{cart}', [CartController::class, 'show']);
Route::post('/carts', [CartController::class, 'store']);
Route::put('/carts/{cart}', [CartController::class, 'update']);
Route::delete('/carts/{cart}', [CartController::class, 'destroy']);
