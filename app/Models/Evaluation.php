<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        "book_id",
        "user_id",
        "evaluation"
    ];

    protected $table = 'book_evaluations';
}
