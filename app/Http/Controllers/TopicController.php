<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function usersShow(Topic $topic)
    {
        $lesson = $topic->with('lesson');

        $exercises = $this->getExercises($topic);
        $nextTopic = $this->getNextTopic($topic);

        return Inertia::render('Topics/Show', [
            'topic' => $topic,
            'exercises' => $exercises,
            'nextTopic' => $nextTopic,
            'lesson' => $lesson
        ]);
    }

    private function getExercises($topic)
    {
        $exercises = $topic->with(['exercises' => function ($query) {
            $query->orderBy('order', 'asc')
                ->where('status', '1');
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
}
