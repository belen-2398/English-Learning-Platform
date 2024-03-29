<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('match_exercises', function (Blueprint $table) {
            $table->id();
            $table->text('left');
            $table->text('right');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_exercises');
    }
};
