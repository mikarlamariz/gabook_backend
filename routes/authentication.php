<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::post("/login", [LoginController::class, 'authenticate']);

Route::post("/register", [LoginController::class, 'store']);

Route::delete("/logout", [LoginController::class, 'logout'])
    ->middleware(ApiAuthMiddleware::class);