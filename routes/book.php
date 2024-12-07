<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/books", [BookController::class, 'index']);
    Route::get("/books/{book}", [BookController::class, 'getById']);
    Route::post("/books", [BookController::class, 'store']);
    Route::delete("/books/{book}", [BookController::class, 'destroy']);
    Route::put("/books/{book}", [BookController::class, 'update']);
});
