<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

// Route::middleware(ApiAuthMiddleware::class)->group(function() {
//     Route::get("/api/v1/authors", [AuthorController::class, 'index']);
//     Route::post("/api/v1/authors", [AuthorController::class, 'store']);
//     Route::put("/api/v1/authors/{author}", [AuthorController::class, 'update']);
//     Route::delete("/api/v1/authors/{author}", [AuthorController::class, 'destroy']);
// });

Route::get("/api/v1/authors", [AuthorController::class, 'index']);
Route::post("/api/v1/authors", [AuthorController::class, 'store']);
Route::put("/api/v1/authors/{author}", [AuthorController::class, 'update']);
Route::delete("/api/v1/authors/{author}", [AuthorController::class, 'destroy']);