<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Resources\UserBookResource;
use App\Models\Author;
use App\Models\UserBooks;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $user = auth('sanctum')->user();
        $books = UserBooks::where('user_id', $user->id)->with('book')->get();

        foreach ($books as $book) {
            $book['author'] = Author::where('id', $book->book->author_id)->first();
        }

        return UserBookResource::collection($books);
    }

    public function store(StoreLibraryRequest $request) {
        $user = auth('sanctum')->user();
        $data = $request->validated();

        if (UserBooks::where('user_id', $user->id)->where('book_id', $data['book_id'])->exists()) {
            return response(null, 200);
        }

        $data['status'] = "Lendo";
        $data['user_id'] = $user->id;
        $bookUser = UserBooks::create($data);
        return new UserBookResource($bookUser);
    }
}
