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
            $table->tinyText('left1');
            $table->tinyText('right1');
            $table->tinyText('left2');
            $table->tinyText('right2');
            $table->tinyText('left3');
            $table->tinyText('right3');
            $table->tinyText('left4')->nullable();
            $table->tinyText('right4')->nullable();
            $table->tinyText('left5')->nullable();
            $table->tinyText('right5')->nullable();
            $table->tinyText('left6')->nullable();
            $table->tinyText('right6')->nullable();
            $table->tinyText('left7')->nullable();
            $table->tinyText('right7')->nullable();
            $table->tinyText('left8')->nullable();
            $table->tinyText('right8')->nullable();
            $table->tinyText('left9')->nullable();
            $table->tinyText('right9')->nullable();
            $table->tinyText('left10')->nullable();
            $table->tinyText('right10')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_exercises');
    }
};
