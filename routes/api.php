<?php

use App\Http\Controllers\Api\V1\ConversationController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::get('/health', [HealthController::class, 'index']);
    Route::get('/conversation/user/{user}', [ConversationController::class, 'findByUser']);
    // Route::get('/conversation', [UserController::class, 'index']);
    // Route::get('/users/{user}', [UserController::class, 'show']);
    // Route::get('/conversation', [ConversationController::class, 'index']);
    // Route::get('/conversation/{conversation}', [ConversationController::class, 'show']);
    // Route::get('/message', [MessageController::class, 'index']);
    // Route::get('/message/{message}', [MessageController::class, 'show']);
});

