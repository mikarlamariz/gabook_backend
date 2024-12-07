<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PostController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::post("/post/{post}/like", [PostController::class, 'like'])->middleware('auth:sanctum');
Route::get("/books/searchByText", [BookController::class, 'searchByText'])->middleware('auth:sanctum');
Route::put("/books/evaluate", [BookController::class, 'EvaluateBook'])->middleware('auth:sanctum');

require_once "authentication.php";
require_once "book.php";
require_once "genre.php";
require_once "author.php";
require_once "status.php";
require_once "user.php";
require_once "post.php";
require_once "library.php";
require_once "comments.php";