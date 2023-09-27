<?php

namespace App\Http\Controllers\NotUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordOfDayRequest;
use App\Models\WordOfDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WordOfDayController extends Controller
{
    public function index(Request $request)
    {
        $wordsOfDay = WordOfDay::search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'word-of-day.index';

        return view('admin.wordsOfDay.index', compact('wordsOfDay', 'actionUrl'));
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

        WordOfDay::create([
            'word' => $validatedData['word'],
            'type' => $validatedData['type'],
            'pronunciation' => $validatedData['pronunciation'],
            'audio' => $validatedData['audio'],
            'definition' => $validatedData['definition'],
            'examples' => [
                $validatedData['example1'],
                $validatedData['example2'],
                $validatedData['example3'],
                $validatedData['example4'],
                $validatedData['example5'],
            ],
            'image' => $validatedData['image'],
            'publish_date' => $validatedData['publish_date']
        ]);

        return redirect()->route('word-of-day.index')->with('message', 'Word of the Day created successfully');
    }

    public function show(WordOfDay $wordOfDay)
    {
        return view('admin.wordsOfDay.show', compact('wordOfDay'));
    }

    public function edit(WordOfDay $wordOfDay)
    {
        return view('admin.wordsOfDay.edit', compact('wordOfDay'));
    }

    //  TODO: return to section in table where the word was afterwards (also for lessons, topics, etc)

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
            'examples' => [
                $validatedData['example1'],
                $validatedData['example2'],
                $validatedData['example3'],
                $validatedData['example4'],
                $validatedData['example5'],
            ],
            'publish_date' => $validatedData['publish_date'],
            'image' => $validatedData['image'] ?? $wordOfDay->image,
        ]);

        return redirect()->route('word-of-day.index')->with('message', 'Word of the Day updated successfully');
    }

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

            return redirect()->route('word-of-day.index')->with('message', 'Word of the Day deleted successfully');
        }
    }
}
