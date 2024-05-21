<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/token', function () {
    return csrf_token();
});

Route::post('/user', [UserController::class, 'store']);

