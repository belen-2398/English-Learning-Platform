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
        Schema::create('completeds', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('exercise_id')->nullable();
            $table->string('topic_id')->nullable();
            $table->string('lesson_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completeds');
    }
};
