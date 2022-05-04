<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/detail', [\App\Http\Controllers\Sellers\AuthController::class, 'authUser']);
    Route::post('/change-password', [\App\Http\Controllers\Sellers\AuthController::class, 'changePassword']);
    Route::post('/logout', [\App\Http\Controllers\Sellers\AuthController::class, 'logout']);
});
