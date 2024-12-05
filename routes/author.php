<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get("/authors", [AuthorController::class, 'index']);
    Route::post("/authors", [AuthorController::class, 'store']);
    Route::put("/authors/{author}", [AuthorController::class, 'update']);
    Route::delete("/authors/{author}", [AuthorController::class, 'destroy']);
});
