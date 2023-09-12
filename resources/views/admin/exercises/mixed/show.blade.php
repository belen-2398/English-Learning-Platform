@extends('layouts.admin')
@section('title', 'Mixed Exercise Show')
@section('content')

<div class="m-6 p-4 flex justify-between">
    <h2 class="head-title">Mixed Exercise: {{ $mixedExercise->type }}</h2>
    <div class="justify-right gap-2 flex">
        <div class="color-button font-semibold justify-center text-center flex items-center rounded">
            <a href="{{ route('mixed-exercises.edit', $mixedExercise->id) }}">
                Edit
            </a>
        </div>
        <div class="color-button bg-slate-200 font-semibold justify-center text-center flex items-center rounded">
            <a href="{{ route('mixed-exercises.index', $mixedExercise->lesson_id) }}">
                Back
            </a>
        </div>
    </div>
</div>
<p class="text-center mx-auto underline">
    To see the exercise as the user will (with the randomized elements, empty sentences, etc.),
    <br>make sure the slide status is set to visible and click
    <a target="_blank" href="{{ route('user.lessons.show', $mixedExercise->lesson_id) }}"
        class="hover:text-yellow-500 text-blue-500">
        here</a>.
</p>
<div class="mx-auto text-center mt-8 border w-3/4 p-4">
    @if ($mixedExercise->type === 'match')
        <div class="flex justify-center gap-20">
            <div class="border-b mb-2 pb-2">
                <h4 class="underline font-semibold mb-2">Words on the left column:</h4>
                @foreach ($mixedExercise->mxexerciseable->left as $leftItem)
                    <p class="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                        {{ $leftItem }}
                    </p>
                @endforeach
            </div>
            <div class="border-b mb-2 pb-2">
                <h4 class="underline font-semibold mb-2">Words on the right column:</h4>
                @foreach ($mixedExercise->mxexerciseable->right as $rightItem)
                    <p class="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                        {{ $rightItem }}
                    </p>
                @endforeach
            </div>
        </div>
    @elseif ($mixedExercise->type === 'fill')
        <div class="flex-col">
            <div class="border-b mb-2 pb-2">
                <h4 class="underline font-semibold mb-2">Words for the user to fill:</h4>
                @if ($mixedExercise->mxexerciseable->words_to_fill)
                    <p lass="text-lg bg-[var(--color-lightest)] rounded p-2 mx-2">
                        {{ $mixedExercise->mxexerciseable->words_to_fill }}
                    </p>
                @else
                    <p>No words for the user to fill.</p>
                @endif
            </div>
            <div>
                <h4 class="underline font-semibold mb-2">Text for the user to fill:</h4>
                <p>{{ $mixedExercise->mxexerciseable->text }}</p>
            </div>
        </div>
    @elseif ($mixedExercise->type === 'order')
        <div class="flex-cols justify-center gap-20 pb-2">
            <h4 class="underline font-semibold mb-2">Sentences to order:</h4>
            <ol class="list-decimal mx-10">
                @foreach ($mixedExercise->mxexerciseable->sentences as $sentence)
                    @if ($sentence)
                        <li class="text-lg rounded my-1">
                            {{ $sentence }}
                        </li>
                    @endif    
                @endforeach
            </ol>
        </div>
    @elseif ($mixedExercise->type === 'select')
        <div class="flex-col">
            <div>
                <h4 class="underline font-semibold mb-2">Text for the user to select from:</h4>
                <p>{{ $mixedExercise->mxexerciseable->text }}</p>
                <h4 class="underline font-semibold mt-4">Answers:</h4>
                <p>{{ $mixedExercise->mxexerciseable->answers }}</p>
            </div>
        </div>
    @endif
</div>
@endsection
