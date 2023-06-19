<?php

namespace App\Http\Controllers;

use App\Models\WordOfDay;
use Inertia\Inertia;

class WordOfDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function usersIndex()
    {
        $wordsOfDay = WordOfDay::where('status', '1')->get();
    }

    /**
     * Show the form for creating a new resource.
     */


    public function usersShow(WordOfDay $wordOfDay)
    {
        return Inertia::render('WordsOfDay/Show', [
            'wordOfDay' => $wordOfDay
        ]);
    }
}
