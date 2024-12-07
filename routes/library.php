<?php

use App\Http\Controllers\Api\LibraryController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get("/library", [LibraryController::class, "index"]);
    Route::post("/library", [LibraryController::class, "store"]);
});