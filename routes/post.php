<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get("/post", [PostController::class, 'index']);
    Route::post("/post", [PostController::class, 'store']);
    Route::delete("/post/{post}", [PostController::class, 'destroy']);
    Route::post("/post/{post}/like", [PostController::class, 'like']);
    Route::get("/post/getAllByUser", [PostController::class, 'getAllByUser']);
});
