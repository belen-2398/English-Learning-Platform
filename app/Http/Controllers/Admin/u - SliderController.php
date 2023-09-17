<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slidersIndex = 'sliders.index';

        $sliders = slider::query();

        $this->applySearch($sliders, $request);
        $this->applySort($sliders, $request);

        $sliders = $sliders->paginate(10)->appends($request->query());

        return view('admin.sliders.index', compact('sliders', 'slidersIndex'));
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
                $query->where('sliders.status', 1);
            } elseif ($statusParameter === 'not-visible') {
                $query->where('sliders.status', 0);
            }
        } else {
            $query->where('sliders.title', 'LIKE', "%{$searchText}%")
                ->orWhere('sliders.description', 'LIKE', "%{$searchText}%")
                ->orWhere('sliders.link', 'LIKE', "%{$searchText}%");
        }
    }

    private function applySort($query, Request $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'title') {
                $query->orderBy('sliders.title', $sort);
            } else {
                $query->orderBy('sliders.created_at', 'desc');
            }
        }
    }

    public function create()
    {
        return view('admin.sliders.create');
    }


    public function store(SliderRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/sliders/', $filename);
            $validatedData['image'] = "images/sliders/$filename";
        } else {
            $validatedData['image'] = null;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
            'link' => $validatedData['link']
        ]);

        return redirect()->route('sliders.index')->with('message', 'Slider created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $destination = $slider->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/sliders/', $filename);
            $validatedData['image'] = "images/sliders/$filename";
        } else {
            $validatedData['image'] = null;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
            'link' => $validatedData['link']
        ]);

        return redirect()->route('sliders.index')->with('message', 'Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if ($slider->count() > 0) {
            $destination = $slider->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $slider->delete();
            return redirect()->back()->with('message', 'Slider deleted successfully');
        }

        return redirect()->back()->with('message', 'Something went wrong');
    }
}
