<?php

namespace App\Http\Controllers;

use App\Models\DictionaryWord;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function review()
    {
        $dictionaryWords = DictionaryWord::where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->whereNotNull('definition')
                    ->orWhereNotNull('translation');
            })->inRandomOrder()->limit(5)->get();

        return Inertia::render('Dictionary/Review', [
            'dictionaryWords' => $dictionaryWords,
        ]);
    }
}
