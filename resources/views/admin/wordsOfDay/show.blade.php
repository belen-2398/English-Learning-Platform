@extends('layouts.admin')
@section('title', 'Word of the Day Show')
@section('content')

<div class="m-6 p-4 flex justify-between">
    <h2 class="head-title">Word of the Day: {{ $wordOfDay->word }}</h2>
    <div class="justify-right gap-2 flex">
        <div class="color-button font-semibold justify-center text-center flex items-center rounded">
            <a  href="{{ route('word-of-day.edit', $wordOfDay->id) }}">
                Edit
            </a>
        </div>
        <div class="color-button bg-slate-200 font-semibold justify-center text-center flex items-center rounded">
            <a href="{{ route('word-of-day.index') }}">
                Back
            </a>
        </div>
    </div>
</div>

<div class="block mt-6">
    <div class="bg-[var(--color-medium1)] h-3/4 w-3/4 mx-auto invisible-border flex-cols relative z-2">
        <div class="flex items-center flex-row">
            @if ($wordOfDay->image)
                <img src="{{ asset("$wordOfDay->image") }}" class="w-auto rounded h-52 mt-3 ml-6 border"
                    alt="{{ $wordOfDay->word }}"> 
            @else
                <p>No image uploaded.</p>
            @endif
            
            <div class="flex flex-col p-4 my-6 border-l pl-6 ml-6">
                <div class="my-3 flex items-center">
                    <h4 class="font-semibold underline w-1/4 mr-20">Type</h4>
                    <p class="text-justify w-3/4">{{ $wordOfDay->type }}</p>
                </div>
                <div class="my-3 flex items-center">
                    <h4 class="font-semibold underline w-1/4 mr-20">Pronunciation</h4>
                    <p class="text-justify w-3/4">{{ $wordOfDay->pronunciation }}</p>
                </div>
                <div class="my-3 flex items-center">
                    <h4 class="font-semibold underline w-1/4 mr-20">Definition</h4>
                    <p class="text-justify w-3/4">{{ $wordOfDay->definition }}</p>
                </div>
                <div class="my-3 flex py-4 items-center">
                    <h4 class="font-semibold underline w-1/4 mr-20">Examples</h4>
                    <div class="text-justify w-3/4">
                        @foreach($wordOfDay->examples as $example)
                            <p>{{ $example }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="my-3 flex-cols py-4 items-center">
                    <h5 class="mb-4 underline">Audio for pronunciation:</h5>
                    @if ($wordOfDay->audio)
                        <audio controls>
                            <source src="{{ asset($wordOfDay->audio) }}" type="audio/{{ pathinfo($wordOfDay->audio, PATHINFO_EXTENSION) }}">
                            Your browser does not support the audio element.
                        </audio>
                    @else
                        <p class="text-justify">No audio uploaded.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="cut-line mx-auto -mt-52 mb-56"></div>
</div>


@endsection
