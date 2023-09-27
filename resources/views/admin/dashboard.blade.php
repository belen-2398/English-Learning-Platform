@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')

<div class="flex">
    <h1 class="mx-auto my-6 text-2xl">Welcome, administrator.</h1>
</div>

<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center gap-4 mb-2">
        <i class="fa-solid fa-user fa-xl" style="color: #808080;"></i>
        {{-- TODO: add link to users after creating users page --}}
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Users</h5>
        </a>
    </div>
    
    <ul>
        <li class="mb-3 font-normal text-gray-500 dark:text-gray-400">New users this week: {{ $newUsers }}</li>
        <li class="mb-3 font-normal text-gray-500 dark:text-gray-400">Total users: {{ $totalUsers }}</li>
    </ul>
   
   
</div>


@endsection