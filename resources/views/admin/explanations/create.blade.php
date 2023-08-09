@extends('layouts.admin')
@section('title', 'Explanation Create')
@section('content')
<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="m-6 p-4 flex justify-between">
        <h2 class="head-title">Add an explanation</h2>
    </div>
    <form action="{{ route('explanations.store') }}" method="POST"
    class="flex-cols pb-10 mx-14">
        @csrf
        <div class="flex justify-between gap-12 mt-4">
            <input type="hidden" name="topic_slide_id" id="topic_slide_id" value="{{ $topicSlideId }}">
            <div class="flex items-center mb-6">
                <textarea name="explanation" id="explanation" cols="100" rows="10"
                    class="bg-gray-200 whitespace-pre-wrap appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('explanation') }}</textarea>
            </div>
        </div>
        <div class="flex items-center justify-center gap-28 mt-4">
            <div class="color-button font-semibold w-1/4 justify-center text-center flex items-center p-4 rounded">
                <button type="submit">
                    Save slide
                </button>
            </div>
        </div>
    </form>  
</div>
@endsection
