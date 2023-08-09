@extends('layouts.admin')
@section('title', 'Topic Slide Index')
@section('content')
{{-- TODO: edit table on click, add sort and status things --}}

    <div class="flex justify-between mb-2">
        <h2 class="head-title">Slides for {{ $topic->name }}</h2>
        <div class="my-4 ml-auto mr-4">
            <a class="color-button" href="{{ route('topic-slides.create', ['topicId' => $topic->id]) }}">New Slide</a>
        </div>
    </div>
    
       
    @if ($topicSlides->count() > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex justify-between">
                                <span>Name</span>
                            </div> 
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Explanation/Exercise
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topicSlides as $topicSlide)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">                   
                            <td class="px-6 py-4">
                                {{ $topicSlide->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $topicSlide->order }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $topicSlide->status == 0 ? '' : 'V' }}
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    @if ($topicSlide->exercise)
                                        <a href="{{ route('exercises.show', $topicSlide->exercise->id) }}"
                                            class="font-medium text-blue-600 dark:text-gray-500 hover:underline">
                                            Show exercise
                                        </a>
                                        <br>
                                        <a href="{{ route('exercises.edit', $topicSlide->exercise->id) }}"
                                            class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                            Edit exercise
                                        </a>
                                    @else
                                        <a href="{{ route('explanations.show', $topicSlide->explanation->id) }}"
                                            class="font-medium text-blue-600 dark:text-gray-500 hover:underline">
                                            Show explanation
                                        </a>
                                        <br>
                                        <a href="{{ route('explanations.edit', $topicSlide->explanation->id) }}"
                                            class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                            Edit explanation
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="">
                                    <a href="{{ route('topic-slides.edit', $topicSlide->id) }}"
                                        class="font-medium text-gray-600 dark:text-gray-500 hover:underline">
                                        Edit data
                                    </a>
                                    <form action="{{ route('topic-slides.destroy', $topicSlide->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this slide?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    @else
        <p>No slides yet.</p>
    @endif

@endsection
