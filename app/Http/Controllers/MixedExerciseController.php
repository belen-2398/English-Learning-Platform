<?php

namespace App\Http\Controllers;

use App\Models\MixedExercise;
use Inertia\Inertia;

class MixedExerciseController extends Controller
{
    public function usersShow(MixedExercise $mixedExercise)
    {
        $mixedExercise->load(['mxexerciseable']);

        return Inertia::render('MixedExercises/Show', [
            'mixedExercise' => $mixedExercise
        ]);
    }
}
