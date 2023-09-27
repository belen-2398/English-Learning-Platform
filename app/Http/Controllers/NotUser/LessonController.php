<?php

namespace App\Http\Controllers\NotUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    // TODO: ver si se puede mantener los resultados del search al aplicar status
    public function index(Request $request)
    {
        $lessons = Lesson::search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'lessons.index';

        return view('admin.lessons.index', compact('lessons', 'actionUrl'));
    }

    public function levelIndex($level, Request $request)
    {
        $lessons = Lesson::where('level', $level)
            ->search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'lessons.level.index';

        return view('admin.lessons.levelIndex', compact('lessons', 'level', 'actionUrl'));
    }

    public function create($level = null)
    {
        return view('admin.lessons.create', compact('level'));
    }

    public function store(LessonRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = $request->status == true ? '1' : '0';

        $lesson = Lesson::create([
            'level' => $validatedData['level'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'order' =>  $validatedData['order']
        ]);

        return redirect()->route('lessons.level.index', ['level' => $lesson->level])->with('message', 'Lesson created successfully');
    }

    public function edit(Lesson $lesson)
    {
        return  view('admin.lessons.edit', compact('lesson'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $validatedData = $request->validated();

        $lesson->update([
            'level' => $validatedData['level'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' =>  $request->status == true ? '1' : '0',
            'order' =>  $validatedData['order']
        ]);

        return redirect()->route('lessons.level.index', ['level' => $lesson->level])->with('message', 'Lesson updated successfully');
    }

    public function destroy(Lesson $lesson)
    {
        $level = $lesson->level;
        $lesson->delete();
        return redirect()->route('lessons.level.index', ['level' => $level])->with('message', 'Lesson deleted successfully');
    }
}
