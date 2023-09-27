@extends('layouts.admin')
@section('title', 'Teacher Dashboard')
@section('content')

<div class="flex">
    <h1 class="mx-auto my-6 text-2xl">Welcome, {{ $user->name }}.</h1>
</div>

<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center gap-4 mb-2">
        <i class="fa-solid fa-message fa-xl" style="color: #808080;"></i>
        {{-- TODO: add link to messages after creating it --}}
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Messages</h5>
        </a>
    </div>
    
    <ul>
        {{-- <li class="mb-3 font-normal text-gray-500 dark:text-gray-400">New messages: {{ $newMessages }}</li> --}}
    </ul>
   
   
</div>


@endsection