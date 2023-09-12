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
        <div class="flex justify-between gap-12 mt-4">
            <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="name">
                        Name
                    </label>
                </div>
                <div class="w-3/4">
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
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
                    <input type="number" name="order" id="order" value="{{ old('order') }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="flex items-center mb-6 w-1/4 justify-between">
                <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="status">
                    Status
                </label>
                <input type="checkbox" name="status" id="status" class="ml-2 mr-4">
                <br>
                <span class="text-sm text-gray-500">
                    Unchecked = Hidden, Checked = visible
                </span>   
            </div>
        </div>
       <p class="font-bold justify-center mx-auto">Select the type of slide to save the data so far
        <br>and move on to the exercise content:</p>
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
