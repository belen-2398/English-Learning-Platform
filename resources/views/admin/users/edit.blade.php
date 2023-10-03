@extends('layouts.admin')
@section('title', 'User Role Update')
@section('content')
<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="m-6 p-4 flex justify-between">
        <h2 class="head-title">Edit user role for {{ $user->name }}</h2>
        <a href="{{ route('admin.users.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
        class="pb-10 pt-6 mr-8">
        @csrf
        @method('PUT')
            <div class="flex justify-center gap-4 mb-6 mx-12">
                <div class="flex items-center justify-between">
                    <label class="block text-gray-500 font-bold text-right pr-2" for="category">
                        User Role
                    </label>
                    <select name="role_as" id="role_as"
                        class="bg-gray-200 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose a role</option>
                        <option value="0" {{ $user->role_as === '0' ? 'selected' : '' }}>User/Student</option>
                        <option value="1" {{ $user->role_as === '1' ? 'selected' : '' }}>Teacher</option>
                    </select>
                </div>
            </div>

        <div class="flex items-center">
            <div class="color-button font-semibold justify-center mx-auto text-center flex items-center p-4">
                <button type="submit">
                    Save changes
                </button>
            </div>
        </div>
    </form>  
</div>
@endsection
