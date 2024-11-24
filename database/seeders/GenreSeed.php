<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeed extends Seeder
{

    protected $genres = [
        ["genre" => "Ficção"],
        ["genre" => "Não-ficção"],
        ["genre" => "Fantasia"],
        ["genre" => "Mistério"],
        ["genre" => "Romance"],
        ["genre" => "Ciência Fiction"],
        ["genre" => "Terror"],
        ["genre" => "Biografia"],
        ["genre" => "Histórico"],
        ["genre" => "Autoajuda"],
        ["genre" => "Literatura Infantojuvenil"],
        ["genre" => "Poesia"],
        ["genre" => "Drama"],
        ["genre" => "Aventura"],
        ["genre" => "Thriller"],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("genres")->upsert($this->genres, ["id"]);
    }
}
