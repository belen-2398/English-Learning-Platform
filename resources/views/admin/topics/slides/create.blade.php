@extends('layouts.admin')
@section('title', 'Slide Create')
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
        <h2 class="head-title">Create slide</h2>
    </div>
    <form action="{{ route('topic-slides.store') }}" method="POST"
    class="flex-cols pb-10 mx-14">
        @csrf
        <div class="flex justify-center gap-20 mt-4">
            <div class="flex items-center mb-6 w-1/3 justify-between">
                <div class="w-1/3 mr-6">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="topic_id">
                        Topic
                    </label>
                </div>
                <div class="w-2/3">
                    <select name="topic_id" id="topic_id"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose topic</option>
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}"
                                    {{ (old('topic_id') === $topic->id || (isset($topicId) && trim($topicId) === trim($topic->id) )) ? 'selected' : '' }}>
                                    {{ $topic->name }}
                                </option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/3 justify-between">
                <div class="w-1/3 mr-6">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="name">
                        Name
                    </label>
                </div>
                <div class="w-2/3">
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <div class="flex items-center mb-6 justify-center">
                <div class="mr-6">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="prompt">
                        Prompt
                    </label>
                </div>
                <div class="w-3/4">
                    <textarea id="prompt" name="prompt" cols="50" rows="2"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('prompt') }}</textarea>
                </div>
            </div>
        </div>
        <div class="flex justify-center gap-20 mt-4">
            <div class="flex items-center mb-6 w-1/3 justify-between">
                <div class="w-1/3 mr-6">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="order">
                        Order number
                    </label>
                </div>
                <div class="w-2/3">
                    <input type="number" name="order" id="order" value="{{ old('order') }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/3 justify-between">
                <div class="w-1/3 mr-6">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="status">
                        Visible?
                    </label>
                </div>
                <div class="w-2/3 flex items-center">
                    <input type="checkbox" name="status" id="status" class="mr-4">
                    <span class="text-sm text-gray-500">
                        Unchecked = hidden <br> Checked = visible
                    </span>
                </div>
            </div>
        </div>

       <p class="font-semibold text-center mx-auto bg-gray-200 text-gray-800 py-4">When you select an option below, the other data will be saved.</p>
       <P class="font-semibold my-4 text-lg">This exercise is an...</P> 
       <div class="flex items-center justify-center gap-28 mt-4">
            <div class="color-button font-semibold w-1/4 justify-center text-center flex items-center p-4 rounded">
                <button type="submit" slideType="explanations">
                    Explanation
                </button>
            </div>
            <div class="color-button font-semibold w-1/4 justify-center text-center flex items-center p-4 rounded">
                <button type="submit" slideType="exercises">
                    Exercise
                </button>
            </div>
            <input type="hidden" name="slideType" id="slideType" value="">
        </div>
    </form>  
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const explanationButton = document.querySelector('[slideType="explanations"]');
        const exerciseButton = document.querySelector('[slideType="exercises"]');

        explanationButton.addEventListener('click', function () {
            document.getElementById('slideType').value = 'explanations';
        });

        exerciseButton.addEventListener('click', function () {
            document.getElementById('slideType').value = 'exercises';
        });
    });
</script>
@endsection
