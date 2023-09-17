
@extends('layouts.admin')
@section('title', 'Level Lesson Index')
@section('content')

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Lesson Index for {{ $level }}</h2>
        <div class="flex">
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('lessons.create', ['level' => $level ]) }}">New {{ $level }} lesson</a>
            </div>
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('lessons.index') }}">See all lessons</a>
            </div>
        </div>
        
    </div>
    <div class="flex items-center">
        <x-search :actionUrl="route($actionUrl, ['level' => $level])">
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                Name
            </option>
            <option value="description" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                Description
            </option>
        </x-search>
        <x-varStatus :actionUrl='$actionUrl' varName='level' :varValue='$level' />        
    </div>
                
    <x-lessonIndex :lessons='$lessons' :actionUrl='$actionUrl' varName='level' :varValue='$level' />

@endsection