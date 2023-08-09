<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\MixedExercise;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
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

        foreach ($lessons as $level => $levelLessons) {
            foreach ($levelLessons as $lesson) {
                $this->checkLessonCompletion($lesson);
            }
        }

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

        foreach ($lessons as $lesson) {
            $this->checkLessonCompletion($lesson);
        }

        return Inertia::render('Lessons/Level', [
            'lessons' => $lessons,
            'level' => $level,
        ]);
    }

    public function from0Index($level)
    {
        $lessons = Lesson::where('level', $level)
            ->where('status', '1')
            ->orderBy('order', 'asc')
            ->with(['topics' => function ($query) {
                $query->where('status', '1')
                    ->orderBy('order', 'asc');
            }])->get();

        $totalLessonCount = $lessons->count();

        $incompleteTopics = [];


        foreach ($lessons as $lesson) {
            $this->checkLessonCompletion($lesson);
            $this->checkTopicCompletion($lesson);

            $incompleteTopics = array_merge($incompleteTopics, $lesson->topics->filter(function ($topic) {
                return !$topic->isCompleted;
            })->all());
        }

        if (!empty($incompleteTopics)) {
            $firstTopicId = $incompleteTopics[0]->id;
        } else {
            $firstTopicId = $lessons[0]->topics[0]->id;
        }

        $completedLessonCount = $lessons->where('isCompleted', 'true')->count();

        $completedLessonPercentage = ($completedLessonCount / $totalLessonCount) * 100;

        return Inertia::render('Lessons/From0', [
            'lessons' => $lessons,
            'level' => $level,
            'firstTopicId' => $firstTopicId,
            'completedLessonPercentage' => $completedLessonPercentage,
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

        $mixedExercises = MixedExercise::where('lesson_id', $lesson->id)
            ->where('status', '1')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/Show', [
            'lesson' => $lesson,
            'grmTopics' => $grmTopics,
            'vocabTopics' => $vocabTopics,
            'mixedExercises' => $mixedExercises,
        ]);
    }

    private function checkLessonCompletion($lesson)
    {
        $lesson->isCompleted = false;

        $topicsCount = $lesson->topics()->where('status', '1')->count();

        $completedTopicsCount = $lesson->topics()
            ->whereHas('users', function ($query) {
                $query->where('id', optional(Auth::user())->id);
            })->count();

        if ($topicsCount === $completedTopicsCount) {
            $lesson->isCompleted = true;
        }
    }

    private function checkTopicCompletion($lesson)
    {
        foreach ($lesson->topics as $topic) {
            $topic->isCompleted = false;

            if ($topic->users()->where('id', optional(Auth::user())->id)->exists()) {
                $topic->isCompleted = true;
            }
        }
    }
}
