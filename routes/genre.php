<?php

use App\Http\Controllers\Api\GenreController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

// Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/api/v1/genres", [GenreController::class, "index"]);
    Route::post("/api/v1/genres", [GenreController::class, "store"]);
    Route::put("/api/v1/genres/{genre}", [GenreController::class, "update"]);
    Route::delete("/api/v1/genres/{genre}", [GenreController::class, "destroy"]);
// });