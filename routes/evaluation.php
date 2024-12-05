<?php

use App\Http\Controllers\Api\EvaluationController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/evaluation", [EvaluationController::class, 'index']);
    Route::post("/evaluation", [EvaluationController::class, 'store']);
    Route::delete("/evaluation/{id}", [EvaluationController::class, 'destroy']);
    Route::put("/evaluation/{id}", [EvaluationController::class, 'update']);
});
