<?php

namespace App\Http\Controllers\NotUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicSlideRequest;
use App\Models\Topic;
use App\Models\TopicSlide;
use Illuminate\Http\Request;

class TopicSlideController extends Controller
{
    public function index(Request $request)
    {
        $topicSlides = TopicSlide::search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'topic-slides.index';
        return view('admin.topics.slides.index', compact('topicSlides', 'actionUrl'));
    }

    public function topicIndex($topicId, Request $request)
    {
        $topic = Topic::findOrFail($topicId);
        $topicSlides = TopicSlide::where('topic_id', $topicId)
            ->search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'topic-slides.topic.index';

        return view('admin.topics.slides.topicIndex', compact('topicSlides', 'topic', 'topicId', 'actionUrl'));
    }

    public function create($topicId = null)
    {
        $topics = Topic::orderBy('name')->get();
        return view('admin.topics.slides.create', compact('topicId', 'topics'));
    }

    public function store(TopicSlideRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topicSlide = TopicSlide::create([
            'topic_id' => $validatedData['topic_id'],
            'name' => $validatedData['name'],
            'prompt' => $validatedData['prompt'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
        ]);

        $slideType = $request->input('slideType');

        if ($slideType === 'explanations') {
            return redirect()->route('explanations.create', ['topicSlideId' => $topicSlide->id]);
        } elseif ($slideType === 'exercises') {
            return redirect()->route('exercises.create', ['topicSlideId' => $topicSlide->id]);
        } else {
            return redirect()->back()->with('error', 'Invalid slide type');
        }
    }

    public function edit(TopicSlide $topicSlide)
    {
        $topics = Topic::orderBy('name')->get();
        return view('admin.topics.slides.edit', compact('topicSlide', 'topics'));
    }

    public function update(TopicSlideRequest $request, TopicSlide $topicSlide)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topicSlide->update([
            'topic_id' => $validatedData['topic_id'],
            'name' => $validatedData['name'],
            'prompt' => $validatedData['prompt'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('topic-slides.topic.index', ['topicId' => $topicSlide->topic_id]);
    }

    public function destroy(TopicSlide $topicSlide)
    {
        $topicId = $topicSlide->topic_id;
        $topicSlide->delete();

        return redirect()->route('topic-slides.topic.index', ['topicId' => $topicId])->with('message', 'Topic Slide deleted successfully');
    }
}
