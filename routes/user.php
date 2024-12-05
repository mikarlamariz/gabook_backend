<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get("/user/image", [UserController::class, 'getUserImage']);
    Route::post("/user/follow", [UserController::class, 'followUser']);
    Route::get("/user/followingAndFollowers", [UserController::class, 'getFollowingAndFollowers']);
});
