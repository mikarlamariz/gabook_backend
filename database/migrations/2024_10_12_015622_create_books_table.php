<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title", 455)->nullable(false);
            $table->text("sinopse")->nullable(false);
            $table->string("cover", 455);
            $table->year("release_year")->nullable(false);
            
            $table->unsignedBigInteger("author_id")->nullable(false);
            $table->foreign("author_id")->references("id")->on("authors");

            $table->unsignedBigInteger("genre_id")->nullable(false);
            $table->foreign("genre_id")->references("id")->on("genres");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
