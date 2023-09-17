@extends('layouts.admin')
@section('title', 'Lesson Topic Index')
@section('content')
    <div class="flex justify-between mb-2">
        <h2 class="head-title">Topic Index for {{ $lesson->name }}</h2>
        <div class="flex">
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('topics.create', ['lessonId' => $lessonId ]) }}">New topic</a>
            </div>
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('topics.index') }}">See all topics</a>
            </div>
        </div>
    </div>

    <div class="flex items-center">
        <x-search :actionUrl="route($actionUrl, ['lessonId' => $lessonId])">
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
            <option value="category" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Category</option>
            <option value="points" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Points</option>
        </x-search>

        <x-varStatus :actionUrl='$actionUrl' varName='lessonId' :varValue='$lessonId' />         
    </div>

    <x-topicIndex :topics='$topics' :actionUrl='$actionUrl' varName='lessonId' :varValue='$lessonId' />
@endsection
