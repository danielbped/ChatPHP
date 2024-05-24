<?php

use App\Http\Controllers\Api\V1\ConversationController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::prefix('health')->group(function() {
        Route::get('/', [HealthController::class, 'index']);
    });

    Route::prefix('conversation')->group(function() {
        Route::get('/user/{user}', [ConversationController::class, 'findByUser']);
        Route::post('/user/{user}', [ConversationController::class, 'store']);
        // Route::get('/', [ConversationController::class, 'index']);
        // Route::get('/{conversation}', [ConversationController::class, 'show']);
    });

    Route::prefix('message')->group(function() {
        Route::post('/conversation/{conversation}', [MessageController::class, 'store']);
        // Route::get('/', [MessageController::class, 'index']);
        // Route::get('/{message}', [MessageController::class, 'show']);
    });

    Route::prefix('users')->group(function() {
        Route::post('/', [UserController::class, 'store']);
        // Route::put('/{user}', [UserController::class, 'update']);
        // Route::get('/{user}', [UserController::class, 'show']);
        // Route::get('/', [UserController::class, 'index']);
    });
});

