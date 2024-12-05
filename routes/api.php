<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

require_once "authentication.php";
require_once "book.php";
require_once "genre.php";
require_once "author.php";
require_once "status.php";
require_once "user.php";
require_once "post.php";
require_once "library.php";