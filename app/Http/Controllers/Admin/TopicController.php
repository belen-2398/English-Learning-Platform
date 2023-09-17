<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // TODO: ver si se puede mantener los resultados del search al aplicar status
    public function index(Request $request)
    {
        $topics = Topic::search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'topics.index';

        return view('admin.topics.index', compact('topics', 'actionUrl'));
    }

    public function lessonIndex($lessonId, Request $request)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $topics = Topic::where('lesson_id', $lessonId)
            ->search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'topics.lesson.index';

        return view('admin.topics.lessonIndex', compact('topics', 'lessonId', 'lesson', 'actionUrl'));
    }

    public function create($lessonId = null)
    {
        $lessonId = (int)$lessonId;
        $lessons = Lesson::orderBy('level')->get()->groupBy('level');
        return view('admin.topics.create', compact('lessons', 'lessonId'));
    }

    public function store(TopicRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topic = Topic::create([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'order' => $validatedData['order'],
            'points' => $validatedData['points'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('topics.lesson.index', ['lessonId' => $topic->lesson_id])->with('message', 'Topic created successfully');
    }

    public function edit(Topic $topic)
    {
        $lessons = Lesson::orderBy('level')->get()->groupBy('level');
        return view('admin.topics.edit', compact('lessons', 'topic'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topic->update([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'order' => $validatedData['order'],
            'points' => $validatedData['points'],
            'status' => $validatedData['status'] == true ? '1' : '0',
        ]);

        return redirect()->route('topics.lesson.index', ['lessonId' => $topic->lesson_id])->with('message', 'Topic updated successfully');
    }

    public function destroy(Topic $topic)
    {
        $lessonId = $topic->lesson_id;
        $topic->delete();
        return redirect()->route('topics.lesson.index', ['lessonId' => $lessonId])->with('message', 'Topic deleted successfully');
    }
}
