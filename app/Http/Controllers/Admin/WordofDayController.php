<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordOfDayRequest;
use App\Models\WordOfDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WordOfDayController extends Controller
{
    public function index(Request $request)
    {
        $wordsOfDayIndex = 'word-of-day.index';

        $wordsOfDay = WordOfDay::query();

        $this->applySearch($wordsOfDay, $request);
        $this->applySort($wordsOfDay, $request);

        $wordsOfDay = $wordsOfDay->paginate(10);

        return view('admin.wordsOfDay.index', compact('wordsOfDay', 'wordsOfDayIndex'));
    }

    private function applySearch($query, Request $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');
        $statusParameter = $request->input('status_parameter');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } elseif ($statusParameter) {
            if ($statusParameter === 'visible') {
                $query->where('status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('status', 0);
            }
        } else {
            $query->where('word', 'LIKE', "%{$searchText}%")
                ->orWhere('type', 'LIKE', "%{$searchText}%")
                ->orWhere('definition', 'LIKE', "%{$searchText}%")
                ->orWhere('example1', 'LIKE', "%{$searchText}%")
                ->orWhere('example2', 'LIKE', "%{$searchText}%")
                ->orWhere('example3', 'LIKE', "%{$searchText}%");
        }
    }

    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'word') {
                $query->orderBy('word', $sort);
            } elseif ($sortBy === 'type') {
                $query->orderBy('type', $sort);
            } else {
                $query->orderBy('created_at', 'desc');
            }
        }
    }

    public function create()
    {
        return view('admin.wordsOfDay.create');
    }

    public function store(WordOfDayRequest $request)
    {
        $validatedData = $request->validated();


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/words/', $filename);
            $validatedData['image'] = "images/words/$filename";
        } else {
            $validatedData['image'] = null;
        }

        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('audios/words/', $filename);
            $validatedData['audio'] = "audios/words/$filename";
        } else {
            $validatedData['audio'] = null;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        WordOfDay::create([
            'word' => $validatedData['word'],
            'type' => $validatedData['type'],
            'pronunciation' => $validatedData['pronunciation'],
            'audio' => $validatedData['audio'],
            'definition' => $validatedData['definition'],
            'example1' => $validatedData['example1'],
            'example2' => $validatedData['example2'],
            'example3' => $validatedData['example3'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status']
        ]);

        return redirect()->route('word-of-day.index')->with('message', 'Word of the Day created successfully');
    }

    public function show(WordOfDay $wordOfDay)
    {
    // TODO: ver si sirve
    }

    public function edit(WordOfDay $wordOfDay)
    {
        return view('admin.wordsOfDay.edit', compact('wordOfDay'));
    }

    /**
     * TODO: return to section in table where the word was afterwards (also for lessons, topics, etc)
     */
    public function update(WordOfDayRequest $request, WordOfDay $wordOfDay)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $destination = $wordOfDay->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/words/', $filename);
            $validatedData['image'] = "images/words/$filename";
        } else {
            $validatedData['image'] = null;
        }

        if ($request->hasFile('audio')) {
            $otherDestination = $wordOfDay->audio;

            if (File::exists($otherDestination)) {
                File::delete($otherDestination);
            }

            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('audios/words/', $filename);
            $validatedData['audio'] = "audios/words/$filename";
        } else {
            $validatedData['audio'] = null;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        WordOfDay::where('id', $wordOfDay->id)->update([
            'word' => $validatedData['word'],
            'type' => $validatedData['type'],
            'pronunciation' => $validatedData['pronunciation'],
            'audio' => $validatedData['audio']  ?? $wordOfDay->audio,
            'definition' => $validatedData['definition'],
            'example1' => $validatedData['example1'],
            'example2' => $validatedData['example2'],
            'example3' => $validatedData['example3'],
            'image' => $validatedData['image'] ?? $wordOfDay->image,
            'status' => $validatedData['status']
        ]);

        return redirect()->route('word-of-day.index')->with('message', 'Word of the Day updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WordOfDay $wordOfDay)
    {
        if ($wordOfDay->count() > 0) {
            $destination = $wordOfDay->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $otherDestination = $wordOfDay->audio;

            if (File::exists($otherDestination)) {
                File::delete($otherDestination);
            }

            $wordOfDay->delete();
            return redirect()->back()->with('message', 'Word of the Day deleted successfully');
        }
    }
}
