<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topic_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->mediumText('prompt')->nullable();
            $table->string('name');
            $table->smallInteger('order')->nullable();
            $table->smallInteger('status')->default('0')->comment('0=not visible, 1=visible');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic_slides');
    }
};
