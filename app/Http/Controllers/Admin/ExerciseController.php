<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $exercisesIndex = 'exercises.index';
        $exercises = Exercise::query()
            ->with('lesson', 'topic');

        $this->applySearch($exercises, $request);
        $this->applySort($exercises, $request);

        $exercises = $exercises->paginate(10)->appends($request->query());

        return view('admin.exercises.index', compact('exercises', 'exercisesIndex'));
    }

    private function applySearch($query, Request $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $statusParameter = $request->input('status_parameter');
        if ($searchParameter) {
            if ($searchParameter === 'lesson') {
                $query->whereHas('lesson', function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', "%{$searchText}%");
                });
            } elseif ($searchParameter === 'topic') {
                $query->whereHas('topic', function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', "%{$searchText}%");
                });
            } else {
                $query->where($searchParameter, 'LIKE', "%{$searchText}%");
            }
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('exercises.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('exercises.status', 0);
            }
        } else {
            $query->where('exercises.level', 'LIKE', "%{$searchText}%")
                ->orWhere('exercises.name', 'LIKE', "%{$searchText}%")
                ->orWhere('exercises.category', 'LIKE', "%{$searchText}%")
                ->orWhereHas('lesson', function ($query) use ($searchText) {
                    $query->where('lessons.name', 'LIKE', "%{$searchText}%");
                })
                ->orWhereHas('topic', function ($query) use ($searchText) {
                    $query->where('topics.name', 'LIKE', "%{$searchText}%");
                })
                ->orWhere('exercises.type', 'LIKE', "%{$searchText}%");
        }
    }

    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('exercises.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('exercises.order', $sort);
            } elseif ($sortBy === 'level') {
                $query->orderBy('exercises.level', $sort);
            } else {
                $query->orderBy('exercises.order', 'asc');
            }
        }
    }

    public function create()
    {
        $lessons = Lesson::all();
        $topics = Topic::all();
        return view('admin.exercises.create', compact('lessons', 'topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Exercise::create([
            'lesson_id' => $validatedData['lesson_id'],
            'topic_id' => $validatedData['topic_id'],
            'name' => $validatedData['name'],
            'level' => $validatedData['level'],
            'category' => $validatedData['category'],
            'order' =>  $validatedData['order'],
            'type' => $validatedData['type'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('exercises.index')->with('message', 'Exercise created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        $lessons = Lesson::all();
        $topics = Topic::all();
        return view('admin.exercises.edit', compact('lessons', 'topics', 'exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = $request->status == true ? '1' : '0';

        $exercise = Exercise::findOrFail($exercise->id)->update([
            'lesson_id' => $validatedData['lesson_id'],
            'topic_id' => $validatedData['topic_id'],
            'name' => $validatedData['name'],
            'level' => $validatedData['level'],
            'category' => $validatedData['category'],
            'order' =>  $validatedData['order'],
            'type' => $validatedData['type'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('exercises.index')->with('message', 'Exercise updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        Exercise::findOrFail($exercise->id)->delete();
        return redirect()->back()->with('message', 'Exercise deleted successfully');
    }
}
