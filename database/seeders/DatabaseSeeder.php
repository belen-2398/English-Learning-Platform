<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Lesson;
use App\Models\Topic;
use App\Models\TopicSlide;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Lesson::factory(10)->create();
        // \App\Models\Topic::factory(10)->create([
        //     'lesson_id' => Lesson::first()->id
        // ]);
        // \App\Models\TopicSlide::factory(10)->create([
        //     'topic_id' => Topic::first()->id
        // ]);
        // \App\Models\Exercise::factory(10)->create([
        //     'topic_slide_id' => TopicSlide::first()->id
        // ]);
        // \App\Models\MixedExercise::factory(10)->create([
        //     'lesson_id' => Lesson::first()->id
        // ]);
        //  \App\Models\OrderExercise::factory(1)->create([
        //  ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'role_as' => '2',
        // ]);
        \App\Models\WordofDay::factory(10)->create();
    }
}
