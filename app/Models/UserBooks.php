<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBooks extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected $table = 'users_books';
}
