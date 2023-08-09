@extends('layouts.admin')
@section('title', 'Slide Edit')
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
        <h2 class="head-title">Edit slide data</h2>
    </div>
    <form action="{{ route('topic-slides.update', $topicSlide->id) }}" method="POST"
    class="flex-cols pb-10 mx-14">
        @csrf
        @method('PUT')
        <div class="flex justify-between gap-12 mt-4">
            <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="name">
                        Name
                    </label>
                </div>
                <div class="w-3/4">
                    <input type="text" id="name" name="name" value="{{ $topicSlide->name }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div>
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="order">
                        Order number
                    </label>
                </div>
                <div class="w-3/4">
                    <input type="number" name="order" id="order" value="{{ $topicSlide->order }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="status">
                    Status
                </label>
                <input type="checkbox" name="status" id="status" class="ml-2 mr-4" {{ $topicSlide->status === 1 ? 'checked' : '' }}>
                <br>
                <span class="text-sm text-gray-500">
                    Unchecked = Hidden, Checked = visible
                </span>   
            </div>
        </div>
        <div class="color-button font-semibold w-1/4 justify-center text-center flex items-center p-4 rounded">
            <button type="submit">
                Save changes
            </button>
        </div>
    </form>  
</div>
@endsection
