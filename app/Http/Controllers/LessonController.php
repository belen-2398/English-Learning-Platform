<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Topic;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function index()
    {
        $levelsOrder = "'A1', 'A2', 'B1', 'B2', 'C1', 'C2'";

        $lessons = Lesson::where('status', '1')
            ->orderByRaw("FIELD(level, $levelsOrder) ASC")
            ->orderBy('order', 'asc')
            ->get()
            ->groupBy('level');

        return Inertia::render('Lessons', [
            'lessons' => $lessons,
        ]);
    }

    public function levelIndex($level)
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', $level)
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/Level', [
            'lessons' => $lessons,
            'level' => $level,
        ]);
    }

    // TODO: add completed property to topics, lessons and exercises and modify controllers accordingly

    public function from0Index($level)
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', $level)
            ->orderBy('order', 'asc')
            ->with(['topics' => function ($query) {
                $query->orderBy('order', 'asc')
                    ->where('status', '1');
            }])
            ->get();

        // $firstTopic = null;

        // foreach ($lessons as $lesson) {
        //     $firstTopic = $lesson->topics->first(function ($topic) {
        //         return !$topic->completed;
        //     });

        //     if ($firstTopic) {
        //         break;
        //     }
        // }

        $firstTopicId = $lessons[0]->topics[0]->id;

        // $firstTopicId = $firstTopic ? $firstTopic->id : $lessons[0]->topics[0]->id;


        return Inertia::render('Lessons/From0', [
            'lessons' => $lessons,
            'level' => $level,
            'firstTopicId' => $firstTopicId,
        ]);
    }

    public function show(Lesson $lesson)
    {
        $topics = Topic::where('lesson_id', $lesson->id)
            ->where('status', '1')
            ->orderBy('order', 'asc')
            ->get();

        $grmTopics = $topics->where('category', 'grammar')->all();
        $vocabTopics = $topics->where('category', 'vocabulary')->all();

        $mixedExercises = Exercise::where('lesson_id', $lesson->id)
            ->where('status', '1')
            ->where('category', 'mixed')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/Show', [
            'lesson' => $lesson,
            'grmTopics' => $grmTopics,
            'vocabTopics' => $vocabTopics,
            'mixedExercises' => $mixedExercises,
        ]);
    }
}
