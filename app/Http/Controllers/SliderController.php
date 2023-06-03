<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();

        return Inertia::render('Admin/Sliders/Index', [
            'sliders' => $sliders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Sliders/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $uploadPath = 'images/Sliders/';
            $uploadedImages = [];

            foreach ($request->file('image') as $index => $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $index . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $uploadedImages[] = $finalImagePathName;
            }

            $validatedData['image'] = json_encode($uploadedImages);
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['title'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        return to_route('sliders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
