@extends('layouts.admin')
@section('title', 'Exercise Show')
@section('content')

<div class="m-6 p-4 flex justify-between">
    <h2 class="head-title">Exercise: {{ $exercise->type }}</h2>
    <div class="justify-right gap-2 flex">
        <div class="color-button font-semibold justify-center text-center flex items-center rounded">
            <a  href="{{ route('exercises.edit', $exercise->id) }}">
                Edit
            </a>
        </div>
        <div class="color-button bg-slate-200 font-semibold justify-center text-center flex items-center rounded">
            <a href="{{ route('topic-slides.index', $exercise->topicSlide->topic->id) }}">
                Back
            </a>
        </div>
    </div>
</div>
<p class="text-center mx-auto underline">
    To see the exercise as the user will (with the randomized elements, empty sentences, etc.),
    <br>make sure the slide is visible and click
    <a target="_blank" href="{{ route('user.topics.show', $exercise->topicSlide->topic->id) }}"
        class="hover:text-yellow-500 text-blue-500">
        here</a>.
</p>
<div class="mx-auto text-center mt-8 border w-3/4 p-4">
    @if ($exercise->type === 'match')
    <div class="flex gap-20">
        <div class="pb-2 w-1/2">
            <h4 class="font-semibold mb-2 pb-2 border-b-2 text-center ml-4">Left column</h4>
            @foreach ($exercise->exerciseable->left as $leftItem)
                <p class="text-lg rounded p-2 ml-2 text-justify mb-2 border-b border-dashed">
                    {{ $leftItem }}
                </p>
            @endforeach
        </div>
        <div class="border-x"></div>
        <div class="pb-2 w-1/2">
            <h4 class="font-semibold mb-2 pb-2 border-b-2 text-center mr-4">Right column</h4>
            @foreach ($exercise->exerciseable->right as $rightItem)
                <p class="text-lg rounded p-2 mr-2 text-justify mb-2 border-b border-dashed">
                    {{ $rightItem }}
                </p>
            @endforeach
        </div>
    </div>
@elseif ($exercise->type === 'fill')
    <div class="flex-col">
        <div class="mb-2 pb-2">
            <h4 class="border-b-2 font-semibold mb-4 pb-2 w-3/4">Words to help the user</h4>
            @if ($exercise->exerciseable->words_to_fill)
                <p lass="text-lg rounded p-2 mx-2">
                    {{ $exercise->exerciseable->words_to_fill }}
                </p>
            @else
                <p>No words for the user to fill.</p>
            @endif
        </div>
        <div>
            <h4 class="border-b-2 font-semibold mb-4 mt-6 pb-2 w-3/4">Text for the user to fill</h4>
            <p class="text-justify mx-6 p-6 border-2 border-dashed">{{ $exercise->exerciseable->text }}</p>
        </div>
    </div>
@elseif ($exercise->type === 'order')
    <div class="flex-cols gap-20 pb-2">
        <h4 class="border-b-2 font-semibold mb-4 ml-6 pb-2 w-3/4 text-left">Sentences to order</h4>
        <ol class="list-decimal mx-10 text-justify">
            @foreach ($exercise->exerciseable->sentences as $sentence)
                @if ($sentence)
                    <li class="text-lg rounded my-3">
                        {{ $sentence }}
                    </li>
                @endif    
            @endforeach
        </ol>
    </div>
@elseif ($exercise->type === 'select')
    <div class="flex-col">
        <div>
            <h4 class="border-b-2 font-semibold mb-4 mt-2 pb-2 w-3/4">Text for the user to select from</h4>
            <p class="text-justify mx-6 p-6 border-2 border-dashed">{{ $exercise->exerciseable->text }}</p>
            <h4 class="border-b-2 font-semibold mb-4 mt-10 pb-2 w-3/4">Answers</h4>
            <p>{{ $exercise->exerciseable->answers }}</p>
        </div>
    </div>
@endif
</div>
@endsection
