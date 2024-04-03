<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/shops', [ShopController::class, 'index']);

require __DIR__ . '/auth.php';
