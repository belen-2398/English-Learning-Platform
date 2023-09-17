@extends('layouts.admin')
@section('title', 'Topic Slide Index')
@section('content')

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Slides for {{ $topic->name }}</h2>
        <div class="flex">
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('topic-slides.create', ['topicId' => $topicId]) }}">New Slide</a>
            </div>
            <div class="my-4 ml-auto mr-4">
                <a class="color-button" href="{{ route('topic-slides.index') }}">See all topic slides</a>
            </div>
        </div>
    </div>

    
    <div class="flex items-center">
        <x-search :actionUrl="route($actionUrl, ['topicId' => $topic->id])">
            <option value="name" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</option>
            <option value="order" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Order</option>
        </x-search>

        <x-varStatus :actionUrl='$actionUrl' varName='topicId' :varValue='$topicId' />                  
    </div>

    <x-topicSlideIndex :topicSlides='$topicSlides' :actionUrl='$actionUrl' varName='topicId' :varValue='$topicId' />

@endsection
