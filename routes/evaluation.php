<?php

use App\Http\Controllers\Api\EvaluationController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/api/v1/evaluation", [EvaluationController::class, 'index']);
    Route::post("/api/v1/evaluation", [EvaluationController::class, 'store']);
    Route::delete("/api/v1/evaluation/{id}", [EvaluationController::class, 'destroy']);
    Route::put("/api/v1/evaluation/{id}", [EvaluationController::class, 'update']);
});
