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
        Schema::create('match_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id')->nullable();
            $table->mediumText('left_column');
            $table->mediumText('right_column');
            $table->foreign('exercise_id')->references('id')->on('exercises')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_exercises');
    }
};
