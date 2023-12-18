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
        // $sliders = Slider::where('status', '1')->get();
        $wordOfDay = WordOfDay::where('publish_date', today())->first();
        $previousWordsOfDay = WordOfDay::where('publish_date', '<', today())
            ->latest()
            ->take(5)
            ->get();

        $topics = Topic::latest()->take('10')->get();

        return Inertia::render('Welcome', [
            // 'sliders' => $sliders,
            'wordOfDay' => $wordOfDay,
            'previousWordsOfDay' => $previousWordsOfDay,
            'topics' => $topics,
        ]);
    }
}
