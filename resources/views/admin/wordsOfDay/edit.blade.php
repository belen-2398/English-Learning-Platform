@extends('layouts.admin')
@section('title', 'Word of the Day Update')
@section('content')
<div>
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>
    @endif
    <div class="m-6 p-4 flex justify-between">
        <h2 class="head-title">Edit word</h2>
        <a href="{{ route('word-of-day.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('word-of-day.update', $wordOfDay->id) }}" method="POST" enctype="multipart/form-data"
        class="w-full max-w-sm m-auto justify-center pb-10">
        @csrf
        @method('PUT')
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="word">
                    Word
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" id="word" name="word" value="{{ $wordOfDay->word }}"
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
                <input type="text" id="type" name="type" value="{{ $wordOfDay->type }}"
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
                <input type="text" id="pronunciation" name="pronunciation" value="{{ $wordOfDay->pronunciation }}"
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
                    @if ($wordOfDay->audio)
                        <audio controls>
                            <source src="{{ asset($wordOfDay->audio) }}" type="audio/{{ pathinfo($wordOfDay->audio, PATHINFO_EXTENSION) }}">
                        Your browser does not support the audio element.
                        </audio>
                    @endif
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
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $wordOfDay->definition }}</textarea>
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
                    <input type="text" id="example1" name="example1" value="{{ $wordOfDay->examples[0] }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                @if (isset($wordOfDay->examples[1]))
                    <div class="mb-2">
                        <input type="text" id="example2" name="example2" value="{{ $wordOfDay->examples[1] }}"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                @else
                    <div class="mb-2">
                        <input type="text" id="example2" name="example2" value="{{ old('example2') }}" hidden
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                @endif
                
                @if (isset($wordOfDay->examples[2]))
                    <div class="mb-2">
                        <input type="text" id="example3" name="example3" value="{{ $wordOfDay->examples[2] }}"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                @else
                    <div class="mb-2">
                        <input type="text" id="example3" name="example3" value="{{ old('example3') }}" hidden
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                @endif
                @if (isset($wordOfDay->examples[3]))
                    <div class="mb-2">
                        <input type="text" id="example4" name="example4" value="{{ $wordOfDay->examples[3] }}"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                @else
                <div class="mb-2">
                    <input type="text" id="example4" name="example4" value="{{ old('example4') }}" hidden
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                @endif
                @if (isset($wordOfDay->examples[4]))
                    <div class="mb-2">
                        <input type="text" id="example5" name="example5" value="{{ $wordOfDay->examples[4] }}"
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </div>
                @else
                <div class="mb-2">
                    <input type="text" id="example5" name="example5" value="{{ old('example5') }}" hidden
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                @endif
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
                <img src="{{ asset("$wordOfDay->image") }}" alt="{{ $wordOfDay->word }}" class="table-image">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <label class="md:w-2/3 block text-gray-500 font-bold" for="publish_date">
                Date to be published
                <br />
                <input type="date" min="2023-09-18" value="{{ $wordOfDay->publish_date }}" name="publish_date" id="publish_date" class="mr-2 leading-tight">
            </label>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <div class="color-button font-semibold text-center">
                    <button type="submit">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </form>  
</div>
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