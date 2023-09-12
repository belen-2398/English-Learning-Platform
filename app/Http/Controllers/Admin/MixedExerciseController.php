<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MixedExerciseRequest;
use App\Models\FillExercise;
use App\Models\Lesson;
use App\Models\MatchExercise;
use App\Models\MixedExercise;
use App\Models\OrderExercise;
use App\Models\SelectExercise;
use Illuminate\Http\Request;


class MixedExerciseController extends Controller
{
    public function index($lessonId, Request $request)
    {
        // $mixedExercisesIndex = 'mixed-exercises.index'; 
        $lesson = Lesson::findOrFail($lessonId);
        $mixedExercises = MixedExercise::where('lesson_id', $lessonId);

        $this->applySearch($mixedExercises, $request);
        $this->applySort($mixedExercises, $request);

        // where('lesson_id', $lessonId)->paginate();
        $mixedExercises = $mixedExercises->paginate(10)->appends($request->query());

        return view('admin.exercises.mixed.index', compact(
            'mixedExercises',
            'lesson',
            // 'mixedExercisesIndex'
        ));
    }

    private function applySearch($query, Request $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        // $statusParameter = $request->input('status_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
            // } elseif ($statusParameter) {
            //     if ($statusParameter === 'visible') {
            //         $query->where('mixed_exercises.status', 1);
            //     } elseif ($statusParameter === 'not-visible') {
            //         $query->where('mixed_exercises.status', 0);
            //     }
        } elseif ($searchText) {
            $query->where(function ($query) use ($searchText) {
                $query->where('mixed_exercises.name', 'LIKE', "%{$searchText}%")
                    ->orWhere('mixed_exercises.type', 'LIKE', "%{$searchText}%");
            });
        }
    }

    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('mixed_exercises.name', $sort);
            } elseif ($sortBy === 'order') {
                $query->orderBy('mixed_exercises.order', $sort);
            } elseif ($sortBy === 'type') {
                $query->orderBy('mixed_exercises.type', $sort);
            } else {
                $query->orderBy('mixed_exercises.order', 'asc');
            }
        }
    }

    public function create($lessonId)
    {
        return view('admin.exercises.mixed.create', compact('lessonId'));
    }

    public function store(MixedExerciseRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

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

        $mixedExercise = $finalExercise->mixedExercise()->create([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
            'type' => $validatedData['type'],
        ]);

        $lesson = $mixedExercise->lesson;

        return redirect()->route('mixed-exercises.index', ['lessonId' => $lesson->id])->with('message', 'Mixed exercise created successfully');
    }

    public function show(MixedExercise $mixedExercise)
    {
        return view('admin.exercises.mixed.show', compact('mixedExercise'));
    }

    public function edit(MixedExercise $mixedExercise)
    {
        $finalExercise = $mixedExercise->mxexerciseable;
        $lessonId = $mixedExercise->lesson->id;
        return view('admin.exercises.mixed.edit', compact('mixedExercise', 'finalExercise', 'lessonId'));
    }
    // TODO: modificar errores de exercise model, controller (index, redirect delete, ), factory y views

    public function update(MixedExerciseRequest $request, MixedExercise $mixedExercise)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';
        $finalExercise = $mixedExercise->mxexerciseable;

        if ($validatedData['type'] === 'match') {
            $finalExercise->update([
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
            $finalExercise->update([
                'text' => $validatedData['fillText'],
                'words_to_fill' => $validatedData['words_to_fill'],
            ]);
        } elseif ($validatedData['type'] === 'order') {
            $finalExercise->update([
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
            $finalExercise->update([
                'text' => $validatedData['selectText'],
                'answers' => $validatedData['selectAnswers'],
            ]);
        }

        $mixedExercise->update([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
            'type' => $validatedData['type'],
        ]);

        $lesson = $mixedExercise->lesson;

        return redirect()->route('mixed-exercises.index', ['lessonId' => $lesson->id])->with('message', 'Mixed exercise updated successfully');
    }

    public function destroy(MixedExercise $mixedExercise)
    {
        $lessonId = $mixedExercise->lesson_id;
        $mixedExercise->mxexerciseable->delete();
        $mixedExercise->delete();

        return redirect()->route('mixed-exercises.index', compact('lessonId'))->with('message', 'Mixed exercise deleted successfully');
    }
}
