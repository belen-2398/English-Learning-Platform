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
        Schema::create('words_of_day', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('type')->nullable();
            $table->string('pronunciation')->nullable();
            $table->string('audio')->nullable();
            $table->mediumText('definition');
            $table->mediumText('example1');
            $table->mediumText('example2')->nullable();
            $table->mediumText('example3')->nullable();
            $table->mediumText('example4')->nullable();
            $table->mediumText('example5')->nullable();
            $table->string('image')->nullable();
            $table->date('publish_date')->nullable();
            $table->timestamps();
            // TODO: add publish date to views and controllers
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words_of_day');
    }
};
