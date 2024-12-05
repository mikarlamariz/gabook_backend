<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get("/books", [BookController::class, 'index']);
    Route::get("/books/{book}", [BookController::class, 'getById']);
    Route::post("/books", [BookController::class, 'store']);
    Route::delete("/books/{book}", [BookController::class, 'destroy']);
    Route::put("/books/{book}", [BookController::class, 'update']);
    Route::get("/books/searchByText", [BookController::class, 'searchByText']);
});
