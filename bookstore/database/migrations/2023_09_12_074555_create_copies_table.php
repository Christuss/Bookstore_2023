<?php

use App\Models\Copy;
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
        Schema::create('copies', function (Blueprint $table) {
            $table->id('copy_id');
            $table->year('publications')->default(date("y"));
            $table->foreignId('book_id')->references('book_id')->on('books');
            //0 in library, 1 at user, 2 damaged
            $table->integer('status')->default(0);
            //0 soft, 1 hard
            $table->boolean('hardcovered')->default(0);
            $table->timestamps();
        });

        Copy::create([
            'book_id' => 1
            
        ]);
        Copy::create([
            'publications' => 2023,
            'book_id' => 2,
            'hardcovered' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
