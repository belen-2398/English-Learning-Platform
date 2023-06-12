<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function usersIndex()
    {
        $topics = Topic::where('status', '1')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
   

    public function usersShow(Topic $topic)
    {
        return Inertia::render('Topics/Show', [
            'topic' => $topic
        ]);
    }


    
}
