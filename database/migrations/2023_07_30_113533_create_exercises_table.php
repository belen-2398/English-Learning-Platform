<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_slide_id');
            $table->unsignedBigInteger('exerciseable_id');
            $table->string('exerciseable_type');
            $table->enum('type', ['match', 'fill', 'select', 'order']);
            $table->foreign('topic_slide_id')->references('id')->on('topic_slides')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
