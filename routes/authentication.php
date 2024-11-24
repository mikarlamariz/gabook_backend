<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::post("/api/v1/login", [LoginController::class, 'authenticate']);

Route::post("/api/v1/register", [LoginController::class, 'store']);

Route::delete("/api/v1/logout", [LoginController::class, 'logout'])
    ->middleware(ApiAuthMiddleware::class);