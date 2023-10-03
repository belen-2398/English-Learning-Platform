<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::search($request)
            ->sort($request)
            ->paginate(10)
            ->appends($request->query());

        $actionUrl = 'admin.users.index';

        $totalUsers = $users->count();

        return view('admin.users.index', compact('totalUsers', 'users', 'actionUrl'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, AdminUserRequest $request)
    {
        $validatedData = $request->validated();

        $user->update([
            'role_as' => $validatedData['role_as'],
        ]);

        return redirect()->route('admin.users.index')->with('message', 'Role updated successfully');
    }
}
