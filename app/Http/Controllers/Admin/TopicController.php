<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topicsIndex = 'topics.index';

        $topics = Topic::query();

        $this->applySearch($topics, $request);
        $this->applySort($topics, $request);

        $topics = $topics->paginate(10)->appends($request->query());

        return view('admin.topics.index', compact('topics', 'topicsIndex'));
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
            } else {
                $query->where($searchParameter, 'LIKE', "%{$searchText}%");
            }
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('topics.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('topics.status', 0);
            }
        } else {
            $query->where('topics.name', 'LIKE', "%{$searchText}%")
                ->orWhere('topics.category', 'LIKE', "%{$searchText}%")
                ->orWhere('topics.points', 'LIKE', "%{$searchText}%")
                ->orWhere('topics.order', 'LIKE', "%{$searchText}%")
                ->orWhereHas('lesson', function ($query) use ($searchText) {
                    $query->where('lessons.name', 'LIKE', "%{$searchText}%");
                });
        }
    }


    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('topics.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('topics.order', $sort);
            } else {
                $query->orderBy('topics.order', 'asc');
            }
        }
    }

    public function create()
    {
        $lessons = Lesson::all();
        return view('admin.topics.create', compact('lessons'));
    }

    public function store(TopicRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        Topic::create([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'order' => $validatedData['order'],
            'points' => $validatedData['points'],
            'status' => $validatedData['status'],
            'explanation1' => $validatedData['explanation1'],
            'explanation2' => $validatedData['explanation2'],
            'explanation3' => $validatedData['explanation3'],
            'explanation4' => $validatedData['explanation4'],
            'explanation5' => $validatedData['explanation5'],
        ]);


        return redirect()->route('topics.index')->with('message', 'Topic created successfully');
    }

    public function edit(Topic $topic)
    {
        $lessons = Lesson::all();
        return view('admin.topics.edit', compact('lessons', 'topic'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        $topic = Topic::findOrFail($topic->id)->update([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'order' => $validatedData['order'],
            'points' => $validatedData['points'],
            'status' => $validatedData['status'] == true ? '1' : '0',
            'explanation1' => $validatedData['explanation1'],
            'explanation2' => $validatedData['explanation2'],
            'explanation3' => $validatedData['explanation3'],
            'explanation4' => $validatedData['explanation4'],
            'explanation5' => $validatedData['explanation5'],
        ]);

        return redirect()->route('topics.index', compact('topic'))->with('message', 'Topic updated successfully');
    }

    public function destroy(Topic $topic)
    {
        $topic = Topic::findOrFail($topic->id)->delete();
        return redirect()->back()->with('message', 'Topic deleted successfully');
    }
}
