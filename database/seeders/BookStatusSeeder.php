<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookStatusSeeder extends Seeder
{

    protected $status = [
        ["status" => "Lido"],
        ["status" => "Lendo"],
        ["status" => "Quero Ler"],
        ["status" => "Abandonado"],
        ["status" => "Relendo"],
        ["status" => "Favoritos"],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("book_status")->upsert($this->status, ["id"]);
    }
}
