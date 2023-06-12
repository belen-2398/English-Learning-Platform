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
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="examples">
                    Examples
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="examples" id="examples" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('examples') }}</textarea>
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
            <label class="md:w-2/3 block text-gray-500 font-bold" for="addToDictionary">
                Add to dictionary?
                <br />
                <input type="checkbox" name="addToDictionary" id="addToDictionary" class="mr-2 leading-tight">
                <span class="text-sm"> <br />
                    Unchecked = don't add, checked = add
                </span>
            </label>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <label class="md:w-2/3 block text-gray-500 font-bold" for="status">
                Status
                <br />
                <input type="checkbox" name="status" id="status" class="mr-2 leading-tight">
                <span class="text-sm"> <br />
                    Unchecked = hidden, checked = visible
                </span>
            </label>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <div class="color-button font-semibold text-center">
                    <button type="submit" id="submitBtn" disabled>
                        Create
                    </button>
                </div>
            </div>
        </div>
    </form>  
</div>

{{-- TODO: if page is refreshed with data still there, button appears as disabled --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;

        function checkRequiredFields() {
            const word = document.getElementById('word').value;
            const definition = document.getElementById('definition').value;
            const examples = document.getElementById('examples').value;

            if (word && definition && examples) {
                submitBtn.disabled = false;
            } else {
                
                submitBtn.disabled = true;
            }
        }

        const requiredFields = document.querySelectorAll('#word, #definition, #examples');
        requiredFields.forEach(function (field) {
            field.addEventListener('input', checkRequiredFields);
        });

        // Prevent double submission

        submitBtn.addEventListener('click', function() {
            submitBtn.disabled = true;
            this.form.submit();
        });
    });
</script>
@endsection
