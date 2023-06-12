<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $lessonsIndex = 'lessons.index';

        $lessons = Lesson::query();

        $this->applySearch($lessons, $request);
        $this->applySort($lessons, $request);

        $lessons = $lessons->paginate(10);

        return view('admin.lessons.index', compact('lessons', 'lessonsIndex'));
    }

    private function applySearch($query, Request $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $statusParameter = $request->input('status_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('lessons.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('lessons.status', 0);
            }
        } else {
            $query->where('lessons.level', 'LIKE', "%{$searchText}%")
                ->orWhere('lessons.name', 'LIKE', "%{$searchText}%")
                ->orWhere('lessons.description', 'LIKE', "%{$searchText}%");
        }
    }

    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('lessons.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('lessons.order', $sort);
            } elseif ($sortBy === 'level') {
                $query->orderBy('lessons.level', $sort);
            } else {
                $query->orderBy('lessons.order', 'asc');
            }
        }
    }

    public function create()
    {
        return view('admin.lessons.create');
    }

    public function store(LessonRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Lesson::create([
            'level' => $validatedData['level'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'order' =>  $validatedData['order']
        ]);

        return redirect()->route('lessons.index')->with('message', 'Lesson created successfully');
    }

    public function show(Lesson $lesson)
    {
        Lesson::findOrFail($lesson);
        return view('admin.lessons.show', compact('lesson'));
    }


    public function edit(Lesson $lesson)
    {
        $lesson = Lesson::findOrFail($lesson->id);
        return  view('admin.lessons.edit', compact('lesson'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $validatedData = $request->validated();

        $lesson = Lesson::where('id', $lesson->id)->first();

        if ($lesson) {
            $lesson->update([
                'level' => $validatedData['level'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'status' =>  $request->status == true ? '1' : '0',
                'order' =>  $validatedData['order']
            ]);

            return redirect()->route('lessons.index')->with('message', 'Lesson updated successfully');
        } else {
            return redirect()->route('lessons.index')->with('message', 'Product ID not found');
        }
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->back()->with('message', 'Lesson deleted successfully');
    }

    // public function search(Request $request, Lesson $lesson)
    // {
    //     $searchParameter = $request->input('query_parameter');
    //     $searchText = $request->input('query');

    //     $lessons = Lesson::where($searchParameter, 'LIKE', "%{$searchText}%")
    //         ->orderBy('order', 'asc')->paginate(10);

    //     return view('admin.lessons.search', compact('lessons'));
    // }
}
