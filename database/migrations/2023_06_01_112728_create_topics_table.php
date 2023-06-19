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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->string('name');
            $table->enum('category', ['grammar', 'vocabulary']);
            $table->smallInteger('order')->nullable();
            $table->smallInteger('points')->default('1');
            $table->smallInteger('status')->default('0')->comment('0=not visible, 1=visible');
            $table->text('explanation1');
            $table->text('explanation2')->nullable();
            $table->text('explanation3')->nullable();
            $table->text('explanation4')->nullable();
            $table->text('explanation5')->nullable();
            $table->foreign('lesson_id')->references('id')->on('lessons')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
