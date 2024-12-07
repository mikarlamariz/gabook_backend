<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluateRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Evaluation;
use App\Models\UserBooks;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books);
    }

    public function searchByText(Request $request)
    {
        $search = $request->query("search");

        if (!isset($search) || $search == null)
            return response(null, 400);

        $books = Book::where('title', 'LIKE', '%' . $search . '%')
        ->orWhere('isbn', '=', $search)
        ->orWhereHas('author', function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->get();

        return response()->json(["data" => $books]);
    }

    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validated();
        $cover = $request->file('cover');
        $coverPath = $cover->store('images', 'public');
        $validatedData["cover"] = 'storage/' . $coverPath;

        $author = Author::firstOrCreate(['name' => $request['author']]);
        $validatedData['author_id'] = $author->id;

        $book = Book::create($validatedData);
        return new BookResource($book);
    }

    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, 204);
    }

    public function getById(Book $book)
    {
        $book->with('author:id,name');

        $isInMyLibrary = UserBooks::where('user_id', auth('sanctum')->user()->id)->where('book_id', $book->id)->exists();
        $book['isInMyLibrary'] = $isInMyLibrary;

        $myEvaluation = Evaluation::where('user_id', auth('sanctum')->user()->id)->where('book_id', $book->id)->first();
        $book['myEvaluation'] = $myEvaluation ? $myEvaluation->evaluation : 0;

        return new BookResource($book);
    }

    public function EvaluateBook(EvaluateRequest $request)
    {
        $user = auth('sanctum')->user();
        $book = Book::where('id', $request->book_id)->first();

        $evaluation = Evaluation::where('user_id', $user->id)->where('book_id', $book->id)->first();

        if ($evaluation == null) {
            $evaluation = Evaluation::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'evaluation' => $request->evaluation
            ]);
        } else {
            $evaluation->update([
                'evaluation' => $request->evaluation
            ]);
        }

        // update book average evaluation
        $evaluations = Evaluation::where('book_id', $book->id)->get();
        $book->evaluation_average = $evaluations->avg('evaluation');
        $book->save();

        return new BookResource($book);
    }

}
