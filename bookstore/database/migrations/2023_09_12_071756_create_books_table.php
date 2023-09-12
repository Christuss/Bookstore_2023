<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Book;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('author', 32);
            $table->string('title', 150);
            $table->integer('pieces')->default(50);
            $table->timestamps();
        });

        Book::create([
            'author' => "Béla",
            'title' => 'Béla kaladjai',
            'pieces' => 4
        ]);
        Book::create([
            'author' => "Jani",
            'title' => 'Jani kaladjai',
            'pieces' => 6
        ]);
        Book::create([
            'author' => "Józsi",
            'title' => 'Józsi kaladjai',
            'pieces' => 102
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
