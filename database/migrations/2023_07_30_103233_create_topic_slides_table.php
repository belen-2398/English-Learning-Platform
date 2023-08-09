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
        Schema::create('topic_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            // $table->unsignedBigInteger('slideable_id')->nullable();
            // $table->string('slideable_type')->nullable();
            $table->string('name');
            $table->smallInteger('order');
            $table->smallInteger('status')->default('0')->comment('0=not visible, 1=visible');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_slides');
    }
};
