<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // TODO: ver si necesito level
    public function up(): void
    {
        // TODO: ver si necesito exercisable_id/type for morph
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->unsignedBigInteger('exerciseable_id')->nullable();
            $table->string('exerciseable_type')->nullable();
            $table->string('name');
            $table->enum('level', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2']);
            $table->enum('category', ['grammar', 'vocabulary', 'mixed']);
            $table->smallInteger('order')->nullable();
            $table->enum('type', ['match', 'fill', 'select', 'order']);
            $table->smallInteger('status')->default('0')->comment('0=not visible, 1=visible');
            $table->foreign('lesson_id')->references('id')->on('lessons')->nullOnDelete();
            $table->foreign('topic_id')->references('id')->on('topics')->nullOnDelete();
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
