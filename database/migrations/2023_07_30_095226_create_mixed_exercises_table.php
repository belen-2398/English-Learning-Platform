<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mixed_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id');
            $table->unsignedBigInteger('exerciseable_id');
            $table->string('exerciseable_type');
            $table->string('name');
            $table->smallInteger('order');
            $table->enum('type', ['match', 'fill', 'select', 'order']);
            $table->smallInteger('status')->default('0')->comment('0=not visible, 1=visible');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mixed_exercises');
    }
};
