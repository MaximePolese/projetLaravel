<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

//Route::get('/csrf', function () {
//    return csrf_token();
//});

require __DIR__ . '/auth.php';
