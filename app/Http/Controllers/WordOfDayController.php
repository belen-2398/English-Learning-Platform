<?php

namespace App\Http\Controllers;

use App\Models\WordOfDay;
use Inertia\Inertia;

class WordOfDayController extends Controller
{
    public function usersShow(WordOfDay $wordOfDay)
    {
        $previousWordsOfDay = WordOfDay::where('publish_date', '<', today())
            ->where('id', '!=', $wordOfDay->id)
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('WordsOfDay/Show', [
            'wordOfDay' => $wordOfDay,
            'previousWordsOfDay' => $previousWordsOfDay,
        ]);
    }
}
