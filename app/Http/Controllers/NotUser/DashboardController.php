<?php

namespace App\Http\Controllers\NotUser;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('not-user.dashboard', compact('user'));
    }
}
