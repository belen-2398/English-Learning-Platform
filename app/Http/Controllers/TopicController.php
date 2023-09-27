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

        $topicSlides = $topic->topicSlides()
            ->where('status', '1')
            ->orderBy('order', 'asc')
            ->with(['explanation', 'exercise.exerciseable'])
            ->get();

        $nextTopic = $this->getNextTopic($topic);

        $completed = $this->completedTopics()->where('id', $topic->id)->exists();

        return Inertia::render('Topics/Show', [
            'topic' => $topic,
            'topicSlides' => $topicSlides,
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
        $completedTopics = $this->completedTopics()
            ->orderBy('order', 'asc')
            ->with('lesson')
            ->get();

        $totalUserPts = $completedTopics->sum('points');

        $userPtCategory = '';
        $nextCatPts = 0;
        $completedCatPercentage = 0;

        // TODO: change categories to Babel theme

        $ptsCategories = [
            0 => 'Baby learner',
            20 => 'First learning steps',
            50 => 'Teenage learning years',
            100 => 'Experienced learner',
            500 => 'Expert learner',
        ];

        foreach ($ptsCategories as $ptsCategory => $categoryName) {
            if ($totalUserPts <= $ptsCategory) {
                $userPtCategory = $categoryName;
                $nextCatPts = $ptsCategory - $totalUserPts;

                $completedCatPercentage = ($totalUserPts / $ptsCategory) * 100;

                break;
            }
        }



        $completed = $completedTopics->groupBy('lesson.name');

        return Inertia::render('Completed', [
            'completed' => $completed,
            'totalUserPts' => $totalUserPts,
            'userPtCategory' => $userPtCategory,
            'nextCatPts' => $nextCatPts,
            'completedCatPercentage' => $completedCatPercentage,
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
