<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Models\Exercise;
use App\Models\FillExercise;
use App\Models\MatchExercise;
use App\Models\OrderExercise;
use App\Models\SelectExercise;

class ExerciseController extends Controller
{
    // public function index(Request $request)
    // {
    //     $exercisesIndex = 'exercises.index';
    //     $exercises = Exercise::query()
    //         ->with('lesson', 'topic');

    //     $this->applySearch($exercises, $request);
    //     $this->applySort($exercises, $request);

    //     $exercises = $exercises->paginate(10)->appends($request->query());

    //     return view('admin.exercises.index', compact('exercises', 'exercisesIndex'));
    // }

    // private function applySearch($query, Request $request)
    // {
    //     $searchParameter = $request->input('query_parameter');
    //     $searchText = $request->input('query');
    //     $statusParameter = $request->input('status_parameter');
    //     if ($searchParameter) {
    //         if ($searchParameter === 'lesson') {
    //             $query->whereHas('lesson', function ($query) use ($searchText) {
    //                 $query->where('name', 'LIKE', "%{$searchText}%");
    //             });
    //         } elseif ($searchParameter === 'topic') {
    //             $query->whereHas('topic', function ($query) use ($searchText) {
    //                 $query->where('name', 'LIKE', "%{$searchText}%");
    //             });
    //         } else {
    //             $query->where($searchParameter, 'LIKE', "%{$searchText}%");
    //         }
    //     } elseif ($statusParameter) {
    //         if ($statusParameter === 'visible') {
    //             $query->where('exercises.status', 1);
    //         } elseif ($statusParameter === 'not-visible') {
    //             $query->where('exercises.status', 0);
    //         }
    //     } else {
    //         $query->where('exercises.level', 'LIKE', "%{$searchText}%")
    //             ->orWhere('exercises.name', 'LIKE', "%{$searchText}%")
    //             ->orWhere('exercises.category', 'LIKE', "%{$searchText}%")
    //             ->orWhereHas('lesson', function ($query) use ($searchText) {
    //                 $query->where('lessons.name', 'LIKE', "%{$searchText}%");
    //             })
    //             ->orWhereHas('topic', function ($query) use ($searchText) {
    //                 $query->where('topics.name', 'LIKE', "%{$searchText}%");
    //             })
    //             ->orWhere('exercises.type', 'LIKE', "%{$searchText}%");
    //     }
    // }

    // private function applySort($query, Request $request)
    // {
    //     $sort = $request->input('sort');
    //     $sortBy = $request->input('sort_by');

    //     if ($sort && $sortBy) {
    //         if ($sortBy === 'name') {
    //             $query->orderBy('exercises.name', $sort);
    //         } elseif ($sortBy === 'order') {
    //             $query->orderBy('exercises.order', $sort);
    //         } elseif ($sortBy === 'level') {
    //             $query->orderBy('exercises.level', $sort);
    //         } else {
    //             $query->orderBy('exercises.order', 'asc');
    //         }
    //     }
    // }

    public function create($topicSlideId)
    {
        return view('admin.exercises.create', compact('topicSlideId'));
    }

    public function store(ExerciseRequest $request)
    {
        $validatedData = $request->validated();

        if ($validatedData['type'] === 'match') {
            $finalExercise = MatchExercise::create([
                'left' => [
                    $validatedData['left1'],
                    $validatedData['left2'],
                    $validatedData['left3'],
                    $validatedData['left4'],
                    $validatedData['left5'],
                    $validatedData['left6'],
                    $validatedData['left7'],
                    $validatedData['left8'],
                    $validatedData['left9'],
                    $validatedData['left10'],
                ],
                'right' => [
                    $validatedData['right1'],
                    $validatedData['right2'],
                    $validatedData['right3'],
                    $validatedData['right4'],
                    $validatedData['right5'],
                    $validatedData['right6'],
                    $validatedData['right7'],
                    $validatedData['right8'],
                    $validatedData['right9'],
                    $validatedData['right10'],
                ],
            ]);
        } elseif ($validatedData['type'] === 'fill') {
            $finalExercise = FillExercise::create([
                'text' => $validatedData['fillText'],
                'words_to_fill' => $validatedData['words_to_fill'],
            ]);
        } elseif ($validatedData['type'] === 'order') {
            $finalExercise = OrderExercise::create([
                'sentences' => [
                    $validatedData['orSentence1'],
                    $validatedData['orSentence2'],
                    $validatedData['orSentence3'],
                    $validatedData['orSentence4'],
                    $validatedData['orSentence5'],
                    $validatedData['orSentence6'],
                    $validatedData['orSentence7'],
                    $validatedData['orSentence8'],
                    $validatedData['orSentence9'],
                    $validatedData['orSentence10'],
                ],
            ]);
        } elseif ($validatedData['type'] === 'select') {
            $finalExercise = SelectExercise::create([
                'text' => $validatedData['selectText'],
                'answers' => $validatedData['selectAnswers'],
            ]);
        }

        $exercise = $finalExercise->exercise()->create([
            'topic_slide_id' => $validatedData['topic_slide_id'],
            'type' => $validatedData['type'],
        ]);

        $topicSlide = $exercise->topicSlide;
        $topic = $topicSlide->topic;

        return redirect()->route('topic-slides.index', ['topicId' => $topic->id])->with('message', 'Exercise slide created successfully');
    }

    public function show(Exercise $exercise)
    {
        return view('admin.exercises.show', compact('exercise'));
    }


    public function edit(Exercise $exercise)
    {
        $finalExercise = $exercise->exerciseable;
        $topicSlideId = $exercise->topicSlide->id;
        return view('admin.exercises.edit', compact('exercise', 'finalExercise', 'topicSlideId'));
    }

    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        if ($validatedData['type'] === 'match') {
            $matchExercise = $exercise->exerciseable;
            $finalExercise = $matchExercise->update([
                'left' => [
                    $validatedData['left1'],
                    $validatedData['left2'],
                    $validatedData['left3'],
                    $validatedData['left4'],
                    $validatedData['left5'],
                    $validatedData['left6'],
                    $validatedData['left7'],
                    $validatedData['left8'],
                    $validatedData['left9'],
                    $validatedData['left10'],
                ],
                'right' => [
                    $validatedData['right1'],
                    $validatedData['right2'],
                    $validatedData['right3'],
                    $validatedData['right4'],
                    $validatedData['right5'],
                    $validatedData['right6'],
                    $validatedData['right7'],
                    $validatedData['right8'],
                    $validatedData['right9'],
                    $validatedData['right10'],
                ],
            ]);
        } elseif ($validatedData['type'] === 'fill') {
            $fillExercise = $exercise->exerciseable;
            $finalExercise = $fillExercise->update([
                'text' => $validatedData['fillText'],
                'words_to_fill' => $validatedData['words_to_fill'],
            ]);
        } elseif ($validatedData['type'] === 'order') {
            $orderExercise = $exercise->exerciseable;
            $finalExercise = $orderExercise->update([
                'sentences' => [
                    $validatedData['orSentence1'],
                    $validatedData['orSentence2'],
                    $validatedData['orSentence3'],
                    $validatedData['orSentence4'],
                    $validatedData['orSentence5'],
                    $validatedData['orSentence6'],
                    $validatedData['orSentence7'],
                    $validatedData['orSentence8'],
                    $validatedData['orSentence9'],
                    $validatedData['orSentence10'],
                ],
            ]);
        } elseif ($validatedData['type'] === 'select') {
            $selectExercise = $exercise->exerciseable;
            $finalExercise = $selectExercise->update([
                'text' => $validatedData['selectText'],
                'answers' => $validatedData['selectAnswers'],
            ]);
        }

        $exercise->update([
            'topic_slide_id' => $validatedData['topic_slide_id'],
            'type' => $validatedData['type'],
        ]);

        return redirect()->route('topic-slides.index', ['topicId' => $exercise->topicSlide->topic->id])->with('message', 'Exercise slide updated successfully');
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->exerciseable->delete();
        $exercise->delete();

        return redirect()->back()->with('message', 'Exercise slide deleted successfully');
    }
}
