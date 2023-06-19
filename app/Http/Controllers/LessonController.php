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
            ->with('topics')
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

    public function from0Index($level)
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', $level)
            ->with('topics')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/From0', [
            'lessons' => $lessons,
            'level' => $level,
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
