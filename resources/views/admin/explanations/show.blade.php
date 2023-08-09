@extends('layouts.admin')
@section('title', 'Explanation Show')
@section('content')
<div class="m-6 p-4 flex justify-between">
    <h2 class="head-title">Explanation</h2>
    <div class="justify-right gap-2 flex">
        <div class="color-button font-semibold justify-center text-center flex items-center rounded">
            <a  href="{{ route('explanations.edit', $explanation->id) }}">
                Edit
            </a>
        </div>
        <div class="color-button bg-slate-200 font-semibold justify-center text-center flex items-center rounded">
            <a href="{{ route('topic-slides.index', $explanation->topicSlide->topic->id) }}">
                Back
            </a>
        </div>
    </div>
</div>
<div class="mx-auto text-center mt-8 border w-3/4 p-4">
    {!! $explanation->explanation !!}
</div>
@endsection
