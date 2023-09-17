
@extends('layouts.admin')
@section('title', 'Mixed Exercise Index')
@section('content')

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Mixed Exercises Index</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('mixed-exercises.create') }}">New mixed exercise</a>
        </div>
    </div>
    <div class="flex items-center">
        <x-search :actionUrl="route($actionUrl)">
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
            <option value="type" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Type</option>
        </x-search>
        <x-status :actionUrl='$actionUrl' /> 
    </div>

    <x-mixedExerciseIndex :mixedExercises='$mixedExercises' :actionUrl='$actionUrl' />

@endsection