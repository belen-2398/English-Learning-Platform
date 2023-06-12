<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function A1Index()
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', 'A1')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/A1', [
            'lessons' => $lessons,
        ]);
    }

    public function A2Index()
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', 'A2')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/A2', [
            'lessons' => $lessons,
        ]);
    }

    public function B1Index()
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', 'B1')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/B1', [
            'lessons' => $lessons,
        ]);
    }

    public function B2Index()
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', 'B2')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/B2', [
            'lessons' => $lessons,
        ]);
    }

    public function C1Index()
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', 'C1')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/C1', [
            'lessons' => $lessons,
        ]);
    }

    public function C2Index()
    {
        $lessons = Lesson::where('status', '1')
            ->where('level', 'C2')
            ->orderBy('order', 'asc')
            ->get();

        return Inertia::render('Lessons/C2', [
            'lessons' => $lessons,
        ]);
    }

    public function A1from0()
    {
        return Inertia::render('Lessons/A1from0', []);
    }

    public function A2from0()
    {
        return Inertia::render('Lessons/A1from0', []);
    }

    public function B1from0()
    {
        return Inertia::render('Lessons/A1from0', []);
    }

    public function B2from0()
    {
        return Inertia::render('Lessons/A1from0', []);
    }

    public function C1from0()
    {
        return Inertia::render('Lessons/A1from0', []);
    }
    public function C2from0()
    {
        return Inertia::render('Lessons/A1from0', []);
    }

    public function show(Lesson $lesson)
    {
        Lesson::findOrFail($lesson);
        return Inertia::render('Lessons/Show', [
            'lesson' => $lesson,
        ]);
    }
}
