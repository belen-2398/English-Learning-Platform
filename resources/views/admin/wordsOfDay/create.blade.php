@extends('layouts.admin')
@section('title', 'Word of the Day Create')
@section('content')
<div>
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>
    @endif
    <div class="m-6 p-4 flex justify-between">
        <h2 class="head-title">Create word</h2>
        <a href="{{ route('word-of-day.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('word-of-day.store') }}" method="POST" enctype="multipart/form-data"
        class="w-full max-w-sm m-auto justify-center pb-10">
        @csrf
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="word">
                    Word
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" id="word" name="word" value="{{ old('word') }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="type">
                    Type
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" id="type" name="type" value="{{ old('type') }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="pronunciation">
                    Pronunciation
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" id="pronunciation" name="pronunciation" value="{{ old('pronunciation') }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="audio">
                    Audio
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="file" id="audio" name="audio"
                    class="w-full py-2 px-4 text-gray-700 leading-tight">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="definition">
                    Definition
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="definition" id="definition" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('definition') }}</textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="example1">
                    Examples
                </label>
            </div>
            <div class="flex-cols md:w-2/3" id="example-fields">
                <div class="mb-2">
                    <input type="text" id="example1" name="example1" value="{{ old('example1') }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="mb-2">
                    <input type="text" id="example2" name="example2" value="{{ old('example2') }}" hidden
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="mb-2">
                    <input type="text" id="example3" name="example3" value="{{ old('example3') }}" hidden
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="mb-2">
                    <input type="text" id="example4" name="example4" value="{{ old('example4') }}" hidden
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="mb-2">
                    <input type="text" id="example5" name="example5" value="{{ old('example5') }}" hidden
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="flex-col justify-center my-4">
                    <button type="button" id="addExampleBtn" class="uppercase text-sm text-white bg-gray-500 p-2 rounded font-semibold my-2 ml-2 flex justify-center">Add Example</button>
                    <p id="maxExamplesMessage" class="text-red-500 p-2 text-center hidden">The maximum number of examples is 5.</p>
                </div>
            </div>
        </div>
        
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="image">
                    Image
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="file" id="image" name="image"
                    class="w-full py-2 px-4 text-gray-700 leading-tight">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <label class="md:w-2/3 block text-gray-500 font-bold" for="publish_date">
                Date to be published
                <br />
                <input type="date" min="2023-09-18" name="publish_date" id="publish_date" class="mr-2 leading-tight">
            </label>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <div class="color-button font-semibold text-center">
                    <button type="submit" id="submitBtn">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </form>  
</div>

{{-- TODO: add autocomplete from dictionary --}}

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('addExampleBtn').addEventListener('click', function () {
            let exampleFieldCount = document.querySelectorAll('input[id^="example"]:not([hidden])').length;
            console.log(exampleFieldCount);
            if (exampleFieldCount >= 5) {
            this.disabled = true;
            document.getElementById('maxExamplesMessage').style.display = 'block';
            return;
        }

        const nextExampleIndex = exampleFieldCount + 1;

        const exampleInput = document.getElementById(`example${nextExampleIndex}`);

        exampleInput.removeAttribute('hidden');
        })
    });
</script>