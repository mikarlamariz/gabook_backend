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
        Schema::create('book_evaluations', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger("book_id")->nullable(false);
            $table->foreign("book_id")->references("id")->on("books");

            $table->unsignedBigInteger("user_id")->nullable(false);
            $table->foreign("user_id")->references("id")->on("users");

            $table->integer("evaluation")->nullable(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_evaluations');
    }
};
