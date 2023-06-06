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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // shortcut for `id`, unsigned big integer (20), primary key, autoincrement

            $table->foreignId('movie_id'); // shortcut for whatever is currently being used as
                                           // type for `id` column - currently (2023) unsigned big integer
            // $table->unsignedBigInteger('movie_id');
            $table->text('text');

            $table->timestamps(); // shortcut for 2 columns - `created_at` (timestamp) & `updated_at` (timestamp)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
