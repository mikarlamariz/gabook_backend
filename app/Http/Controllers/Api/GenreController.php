<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $books = Genre::all();
        return GenreResource::collection($books);
    }

    public function store(StoreGenreRequest $request)
    {
        $book = Genre::create($request->validated());
        return new GenreResource($book);
    }

    public function update(StoreGenreRequest $request, Genre $genre)
    {
        $genre->update($request->validated());
        return new GenreResource($genre);
    }

    public function destroy(Genre $genre)
    {        
        $genre->delete();
        return response(null, 204);
    }
}