<?php

use App\Http\Controllers\Api\GenreController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/genres", [GenreController::class, "index"]);
    Route::post("/genres", [GenreController::class, "store"]);
    Route::put("/genres/{genre}", [GenreController::class, "update"]);
    Route::delete("/genres/{genre}", [GenreController::class, "destroy"]);
});