<?php

use App\Http\Controllers\Api\StatusController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

// Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/api/v1/status", [StatusController::class, 'index']);
    Route::post("/api/v1/status", [StatusController::class, 'store']);
    Route::delete("/api/v1/status/{status}", [StatusController::class, 'destroy']);
    Route::put("/api/v1/status/{status}", [StatusController::class, 'update']);
// });
