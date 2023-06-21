<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompletedRequest;
use App\Models\Completed;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CompletedController extends Controller
{
    public function index()
    {
        // TODO: try to simplify $topics
        $completed = Completed::where('user_id', Auth::id())->pluck('topic_id')->toArray();

        $topics = Topic::whereIn('id', $completed)->get();

        $lessonIds = $topics->pluck('lesson')->unique()->pluck('id')->toArray();

        $lessons = Lesson::whereIn('id', $lessonIds)
            ->orderBy('level', 'asc')
            ->with(['topics' => function ($query) use ($completed) {
                $query->whereIn('id', $completed)
                    ->orderBy('order', 'asc');
            }])->get();

        return Inertia::render('Completed', [
            'topics' => $topics,
            'lessons' => $lessons,
        ]);
    }

    public function store(CompletedRequest $request)
    {
        $validatedData = $request->validated();
        Completed::create([
            'user_id' => Auth::id(),
            'exercise_id' => $validatedData['exercise_id'] ?? null,
            'topic_id' => $validatedData['topic_id'] ?? null,
            'lesson_id' => $validatedData['lesson_id'] ?? null,
        ]);
    }

    // public function update(CompletedRequest $request, Completed $completed)
    // {
    //     $validatedData = $request->validated();
    //     $completed->update([
    //         'user_id' => Auth::id(),
    //         'exercise_id' => $validatedData['exercise_id'] ?? null,
    //         'topic_id' => $validatedData['topic_id'] ?? null,
    //         'lesson_id' => $validatedData['lesson_id'] ?? null,
    //     ]);
    // }

    public function destroy(Completed $completed)
    {
        $completed->delete();
    }
}
