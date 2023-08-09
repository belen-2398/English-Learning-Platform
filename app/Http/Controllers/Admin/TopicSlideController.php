<?php

// TODO: ver si necesito show en todos
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicSlideRequest;
use App\Models\Topic;
use App\Models\TopicSlide;
use Illuminate\Http\Request;

class TopicSlideController extends Controller
{
    public function index($topicId, Request $request)
    {
        $topic = Topic::where('id', $topicId)->first();
        $topicSlides = $topic->topicSlides;
        $topicSlides = $topicSlides->sortBy('order');

        return view('admin.topics.slides.index', compact('topicSlides', 'topic'));
    }

    public function create($topicId)
    {
        $topic = Topic::where('id', $topicId)->first();
        return view('admin.topics.slides.create', compact('topic'));
    }

    public function store(TopicSlideRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topicSlide = TopicSlide::create([
            'topic_id' => $validatedData['topic_id'],
            'name' => $validatedData['name'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
        ]);

        $slideType = $request->input('slideType');

        if ($slideType === 'explanations') {
            return redirect()->route('explanations.create', ['topicSlideId' => $topicSlide->id]);
        } elseif ($slideType === 'exercises') {
            return redirect()->route('exercises.create', ['topicSlideId' => $topicSlide->id]);
        }else {
            return redirect()->back()->with('error', 'Invalid slide type');
        }
        
    }

    public function show(TopicSlide $topicSlide)
    {
        //
    }


    public function edit(TopicSlide $topicSlide)
    {
        $topic = Topic::where('id', $topicSlide->topic_id)->first();
        return view('admin.topics.slides.edit', compact('topic', 'topicSlide'));
    }

    public function update(TopicSlideRequest $request, TopicSlide $topicSlide)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topicSlide->update([
            'topic_id' => $validatedData['topic_id'],
            'name' => $validatedData['name'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('topic-slides.index', ['topicId' => $topicSlide->topic_id]);
    }

    public function destroy(TopicSlide $topicSlide)
    {
        $topicId = $topicSlide->topic_id;
        $topicSlide->delete();

        return redirect()->route('topic-slides.index', ['topicId' => $topicId]);
    }
}
