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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->string('name');
            $table->enum('category', ['grammar', 'vocabulary', 'mixed']);
            $table->smallInteger('order')->unique()->nullable();
            $table->enum('type', ['match', 'fill', 'select', 'order']);
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
