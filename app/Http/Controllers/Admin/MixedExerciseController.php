<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MixedExerciseRequest;
use App\Models\MatchExercise;
use App\Models\MixedExercise;
use Illuminate\Http\Request;

// TODO: completar con otros exercise types acá y el request y crear index para exercises de un cierto lesson y otro index para general

class MixedExerciseController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin.exercises.mixed.create');
    }

    public function store(MixedExerciseRequest $request)
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
            # code...
        } elseif ($validatedData['type'] === 'order') {
            # code...
        } elseif ($validatedData['type'] === 'select') {
            # code...
        }

       $exercise = $finalExercise->exercise()->create([
            'lesson_id' => $validatedData['lesson_id'],
            'name' => $validatedData['name'],
            'order' => $validatedData['order'],
            'status' => $validatedData['status'],
            'type' => $validatedData['type'],
        ]);

        $lesson = $exercise->lesson;

        return redirect()->route('mixed-exercises.index', ['lessonId' => $lesson->id])->with('message', 'Exercise slide created successfully');
    }

    public function show(MixedExercise $mixedExercise)
    {
        //
    }

    public function edit(MixedExercise $mixedExercise)
    {
        //
    }

    public function update(Request $request, MixedExercise $mixedExercise)
    {
        //
    }

    public function destroy(MixedExercise $mixedExercise)
    {
        //
    }
}
