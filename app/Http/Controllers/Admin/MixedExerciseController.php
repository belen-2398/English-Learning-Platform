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
    // TODO: ver si se puede mantener los resultados del search al aplicar status
    public function index(Request $request)
    {
        $mixedExercises = MixedExercise::search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'mixed-exercises.index';

        return view('admin.exercises.mixed.index', compact(
            'mixedExercises',
            'actionUrl'
        ));
    }

    public function lessonIndex($lessonId, Request $request)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $mixedExercises = MixedExercise::where('lesson_id', $lessonId)
            ->search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'mixed-exercises.lesson.index';

        return view('admin.exercises.mixed.lessonIndex', compact(
            'mixedExercises',
            'lesson',
            'lessonId',
            'actionUrl'
        ));
    }

    public function create($lessonId = null)
    {
        $lessons = Lesson::orderBy('level')->get()->groupBy('level');
        return view('admin.exercises.mixed.create', compact('lessonId', 'lessons'));
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

        return redirect()->route('mixed-exercises.lesson.index', ['lessonId' => $lesson->id])->with('message', 'Mixed exercise created successfully');
    }

    public function show(MixedExercise $mixedExercise)
    {
        return view('admin.exercises.mixed.show', compact('mixedExercise'));
    }

    public function edit(MixedExercise $mixedExercise)
    {
        $lessons = Lesson::orderBy('level')->get()->groupBy('level');
        $finalExercise = $mixedExercise->mxexerciseable;
        $lessonId = $mixedExercise->lesson->id;
        return view('admin.exercises.mixed.edit', compact('mixedExercise', 'lessons', 'finalExercise', 'lessonId'));
    }

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

        return redirect()->route('mixed-exercises.lesson.index', ['lessonId' => $lesson->id])->with('message', 'Mixed exercise updated successfully');
    }

    public function destroy(MixedExercise $mixedExercise)
    {
        $lessonId = $mixedExercise->lesson_id;
        $mixedExercise->mxexerciseable->delete();
        $mixedExercise->delete();

        return redirect()->route('mixed-exercises.lesson.index', compact('lessonId'))->with('message', 'Mixed exercise deleted successfully');
    }
}
