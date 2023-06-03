<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        return Inertia::render('Welcome', [
            'sliders' => $sliders
        ]);
    }
}
