<?php

namespace App\Http\Controllers;

use App\Http\Requests\DictionaryWordRequest;
use App\Models\DictionaryWord;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DictionaryWordController extends Controller
{
    public function index(Request $request)
    {
        $dictionaryWords = DictionaryWord::where('user_id', Auth::user()->id)
                            ->searchAndSort($request)
                            // ->search($request)
                            // ->sort($request)
                            ->get();

        return Inertia::render('Dictionary/Words', [
            'dictionaryWords' => $dictionaryWords,
        ]);
    }

    public function store(DictionaryWordRequest $request)
    {
        $validatedData = $request->validated();
        DictionaryWord::create([
            'user_id' => Auth::user()->id,
            'word' => $validatedData['word'],
            'notes' => $validatedData['notes'],
            'definition' => $validatedData['definition'],
            'pronunciation'  => $validatedData['pronunciation'],
            'examples' =>  [
                $validatedData['example1'],
                $validatedData['example2'],
                $validatedData['example3'],
                $validatedData['example4'],
                $validatedData['example5'],
            ],
            'translation' => $validatedData['translation'],
        ]);
    }

    public function update(DictionaryWordRequest $request, $dictionary)
    {
        $validatedData = $request->validated();
        
        DictionaryWord::findOrFail($dictionary)
            ->update([
                'user_id' => Auth::user()->id,
                'word' => $validatedData['word'],
                'notes' => $validatedData['notes'],
                'definition' => $validatedData['definition'],
                'pronunciation'  => $validatedData['pronunciation'],
                'examples' =>  [
                    $validatedData['example1'],
                    $validatedData['example2'],
                    $validatedData['example3'],
                    $validatedData['example4'],
                    $validatedData['example5'],
                ],
                'translation' => $validatedData['translation'],
            ]);
    }

    public function destroy($dictionary)
    {
        DictionaryWord::findOrFail($dictionary)->delete();
    }
}
