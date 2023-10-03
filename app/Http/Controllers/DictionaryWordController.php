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
        // TODO: pasar search and sort a model
        $dictionaryWords = DictionaryWord::where('user_id', Auth::user()->id);

        $this->applySearch($dictionaryWords, $request);
        $this->applySort($dictionaryWords, $request);

        $dictionaryWords = $dictionaryWords->get();

        return Inertia::render('Dictionary/Words', [
            'dictionaryWords' => $dictionaryWords,
        ]);
    }

    private function applySearch($query, Request $request)
    {
        $searchText = $request->input('query');

        $query->where('word', 'LIKE', "%{$searchText}%")
            ->orWhere('notes', 'LIKE', "%{$searchText}%")
            ->orWhere('definition', 'LIKE', "%{$searchText}%")
            ->orWhere('pronunciation', 'LIKE', "%{$searchText}%")
            ->orWhere('translation', 'LIKE', "%{$searchText}%");
    }

    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');

        if ($sort) {
            if ($sort === 'word.asc') {
                $query->orderBy('word', 'asc');
            } elseif ($sort === 'word.desc') {
                $query->orderBy('word', 'desc');
            } elseif ($sort === 'created.asc') {
                $query->orderBy('created_at', 'asc');
            } elseif ($sort === 'created.desc') {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('word', 'asc');
        }
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
