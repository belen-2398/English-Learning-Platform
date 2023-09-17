<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExplanationRequest;
use App\Models\Explanation;
use App\Models\TopicSlide;
use Illuminate\Http\Request;

class ExplanationController extends Controller
{
    public function create($topicSlideId)
    {
        return view('admin.explanations.create', compact('topicSlideId'));
    }

    public function store(ExplanationRequest $request)
    {
        $validatedData = $request->validated();

        $explanation = Explanation::create([
            'topic_slide_id' => $validatedData['topic_slide_id'],
            'explanation' => $validatedData['explanation'],
        ]);

        $topicSlide = $explanation->topicSlide;
        $topic = $topicSlide->topic;
        return redirect()->route('topic-slides.index', ['topicId' => $topic->id])->with('message', 'Explanation slide created successfully');
    }


    public function show(Explanation $explanation)
    {
        $topicSlideId = $explanation->topicSlide->id;
        return view('admin.explanations.show', compact('topicSlideId', 'explanation'));
    }

    public function edit(Explanation $explanation)
    {
        $topicSlideId = $explanation->topicSlide->id;
        return view('admin.explanations.edit', compact('topicSlideId', 'explanation'));
    }

    public function update(ExplanationRequest $request, Explanation $explanation)
    {
        $validatedData = $request->validated();

        $explanation->update([
            'topic_slide_id' => $validatedData['topic_slide_id'],
            'explanation' => $validatedData['explanation'],
        ]);

        $topicSlide = $explanation->topicSlide;
        $topic = $topicSlide->topic;

        return redirect()->route('topic-slides.index', ['topicId' => $topic->id])->with('message', 'Explanation updated successfully');
    }
}
