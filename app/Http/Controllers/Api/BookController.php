<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
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
        $searchBy = $request->query("searchBy");

        if(!isset($search) || $search == null)
            return response(null, 400);

        if($searchBy == null) $searchBy = "title";

        $books = null;
        if($searchBy == "title")
            $books = Book::where('title', 'LIKE', '%' . $search . '%')->get();
        if($searchBy == "author")            
            $books = Book::whereHas('author', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->get();
        if($searchBy == "isbn")
            $books = Book::where('isbn', '=', $search)->get();

        return response()->json(["data" => $books]);
    }

    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData["cover"] = "teste";
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
        return new BookResource($book);
    }

}