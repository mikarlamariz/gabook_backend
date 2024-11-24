<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "sinopse",
        "cover",
        "release_year",
        "evaluation_average",
        "isbn",
        "author_id",
        "genre_id"
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
