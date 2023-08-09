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
        <div class="flex justify-center gap-20">
            <div class="border-b mb-2 pb-2">
                <h4 class="underline font-semibold mb-2">Words on the left column:</h4>
                @foreach ($exercise->exerciseable->left as $leftItem)
                    <p class="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                        {{ $leftItem }}
                    </p>
                @endforeach
            </div>
            <div class="border-b mb-2 pb-2">
                <h4 class="underline font-semibold mb-2">Words on the right column:</h4>
                @foreach ($exercise->exerciseable->right as $rightItem)
                    <p class="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                        {{ $rightItem }}
                    </p>
                @endforeach
            </div>
        </div>
    @elseif ($exercise->type === 'fill')
        <div class="flex-col">
            <div class="border-b mb-2 pb-2">
                <h4 class="underline font-semibold mb-2">Words for the user to fill:</h4>
                @if ($exercise->exerciseable->words_to_fill)
                    <p lass="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                        {{ $exercise->exerciseable->words_to_fill }}
                    </p>
                @else
                    <p>No words for the user to fill.</p>
                @endif
            </div>
            <div>
                <h4 class="underline font-semibold mb-2">Text for the user to fill:</h4>
                <p>{{ $exercise->exerciseable->text }}</p>
            </div>
        </div>
    @elseif ($exercise->type === 'order')
    <div class="flex-cols justify-center gap-20 pb-2">
        <h4 class="underline font-semibold mb-2">Sentences to order:</h4>
        <ol class="list-decimal mx-10">
            @foreach ($exercise->exerciseable->sentences as $sentence)
                @if ($sentence)
                    <li class="text-lg rounded my-1">
                        {{ $sentence }}
                    </li>
                @endif    
            @endforeach
        </ol>
    </div>
    @elseif ($exercise->type === 'select')
    <div class="flex-col">
        <div>
            <h4 class="underline font-semibold mb-2">Text for the user to select from:</h4>
            <p>{{ $exercise->exerciseable->text }}</p>
            <h4 class="underline font-semibold mt-4">Answers:</h4>
            <p>{{ $exercise->exerciseable->answers }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
