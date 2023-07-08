<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Topic;
use App\Models\WordofDay;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '1')->get();
        $wordOfDay = WordOfDay::where('status', '1')->latest()->first();
        $topics = Topic::latest()->take('10')->get();

        return Inertia::render('Welcome', [
            'sliders' => $sliders,
            'wordOfDay' => $wordOfDay,
            'topics' => $topics,
        ]);
    }
}
