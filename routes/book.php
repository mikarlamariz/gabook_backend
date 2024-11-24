<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

// Route::middleware(ApiAuthMiddleware::class)->group(function() {
//     Route::get("/api/v1/books", [BookController::class, 'index']);
//     Route::post("/api/v1/books", [BookController::class, 'store']);
//     Route::delete("/api/v1/books/{id}", [BookController::class, 'destroy']);
//     Route::put("/api/v1/books", [BookController::class, 'update']);
//     Route::get("/api/v1/books/searchByText", [BookController::class, 'searchByText']);
// });

Route::get("/api/v1/books", [BookController::class, 'index']);
Route::post("/api/v1/books", [BookController::class, 'store']);
Route::delete("/api/v1/books/{id}", [BookController::class, 'destroy']);
Route::put("/api/v1/books/{book}", [BookController::class, 'update']);
Route::get("/api/v1/books/searchByText", [BookController::class, 'searchByText']);