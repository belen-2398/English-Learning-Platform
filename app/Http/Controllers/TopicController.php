<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function usersShow(Topic $topic)
    {
        $topic->with('lesson');

        $lesson = $topic->lesson;

        $exercises = $this->getExercises($topic);
        $nextTopic = $this->getNextTopic($topic);

        $completed = $this->completedTopics()->where('id', $topic->id)->exists();

        return Inertia::render('Topics/Show', [
            'topic' => $topic,
            'exercises' => $exercises,
            'nextTopic' => $nextTopic,
            'lesson' => $lesson,
            'completed' => $completed,
        ]);
    }

    private function completedTopics()
    {
        return Topic::whereHas('users', function ($query) {
            $query->where('id', optional(Auth::user())->id);
        });
    }

    public function completedIndex()
    {
        $completed = $this->completedTopics()
            ->orderBy('order', 'asc')
            ->with('lesson')
            ->get()
            ->groupBy('lesson.name');

        return Inertia::render('Completed', [
            'completed' => $completed,
        ]);
    }

    public function markAsCompleted(Topic $topic)
    {
        $userId = Auth::user()->id;
        $topic->users()->attach($userId);
    }

    public function deleteAsCompleted(Topic $topic)
    {
        $userId = Auth::user()->id;
        $topic->users()->detach($userId);
    }

    private function getExercises($topic)
    {
        $exercises = $topic->with(['exercises' => function ($query) {
            $query->where('status', '1')
                ->orderBy('order', 'asc');
        }])->get();

        return $exercises;
    }

    private function getNextTopic(Topic $topic)
    {
        $nextTopic = Topic::where('lesson_id', $topic->lesson_id)
            ->where('status', '1')
            ->where('order', '>', $topic->order)
            ->orderBy('order')
            ->first();

        return $nextTopic;
    }

    public function getDefinition($word)
    {
        $url = "https://api.dictionaryapi.dev/api/v2/entries/en/" . $word;
        $response = Http::get($url);

        if ($response->failed()) {
            $data = null;
        } else {
            $data = $response->json();
        }

        return response()->json(['data' => $data], Response::HTTP_OK);
    }
}
