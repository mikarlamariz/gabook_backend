<?php

use App\Http\Controllers\Api\StatusController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/status", [StatusController::class, 'index']);
    Route::post("/status", [StatusController::class, 'store']);
    Route::delete("/status/{status}", [StatusController::class, 'destroy']);
    Route::put("/status/{status}", [StatusController::class, 'update']);
});