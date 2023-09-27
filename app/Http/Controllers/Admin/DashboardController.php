<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $users = User::all();
        $totalUsers = $users->count();
        $newUsers = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

        return view('admin.dashboard', compact('totalUsers', 'newUsers'));
    }
}
