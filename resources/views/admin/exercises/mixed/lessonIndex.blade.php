
@extends('layouts.admin')
@section('title', 'Lesson Mixed Exercise Index')
@section('content')

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Mixed Exercises Index for {{ $lesson->name }}</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('mixed-exercises.create', [$lesson->id]) }}">New mixed exercise</a>
        </div>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('mixed-exercises.index') }}">See all mixed exercises</a>
        </div>
    </div>
    <div class="flex items-center">
        <x-search :actionUrl="route($actionUrl, ['lessonId' => $lesson->id])">
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
            <option value="type" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Type</option>
        </x-search>
        
        <x-varStatus :actionUrl='$actionUrl' varName='lessonId' :varValue='$lessonId' />    
    </div>

 <x-mixedExerciseIndex :mixedExercises='$mixedExercises' :actionUrl='$actionUrl' varName='lessonId' :varValue='$lessonId' />
@endsection