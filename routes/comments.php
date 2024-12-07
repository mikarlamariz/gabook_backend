<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ApiAuthMiddleware::class)->group(function() {
    Route::get("/commentsByPostId/{post}", [PostController::class, "getCommentByPostId"]);
    Route::post("/comment", [PostController::class, "makeComment"]);
});