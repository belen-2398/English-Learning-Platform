@extends('layouts.admin')
@section('title', 'Topic Update')
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
        <h2 class="head-title">Edit topic</h2>
        <a href="{{ route('topics.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('topics.update', $topic->id) }}" method="POST"
        class="pb-10 pt-6 mr-8">
        @csrf
        @method('PUT')
            <div class="flex justify-between gap-4 mb-6 mx-12">
                <div class="flex items-center justify-between w-1/4">
                    <label class="block text-gray-500 font-bold pr-2 w-1/4" for="name">
                        Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ $topic->name }}"
                        class="bg-gray-200 w-3/4 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="flex items-center justify-between w-1/4">
                    <label class="block text-gray-500 font-bold text-right pr-2 w-1/4" for="lesson_id">
                        Lesson
                    </label>
                    <select name="lesson_id" id="lesson_id"
                        class="bg-gray-200 w-3/4 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose lesson</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{  $topic->lesson_id === $lesson->id ? 'selected' : '' }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between w-1/4">
                    <label class="block text-gray-500 font-bold text-right pr-2 w-1/3" for="category">
                        Category
                    </label>
                    <select name="category" id="category"
                        class="bg-gray-200 w-2/3 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose category</option>
                        <option value="grammar" {{ $topic->category === 'grammar' ? 'selected' : '' }}>Grammar</option>
                        <option value="vocabulary" {{ $topic->category === 'vocabulary' ? 'selected' : '' }}>Vocabulary</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between gap-4 mb-6 mx-12">
                <div class="flex items-center justify-between w-1/4">
                    <label class="block text-gray-500 font-bold text-right pr-2 w-1/4" for="order">
                        Topic order
                    </label>
                    <input type="number" name="order" id="order" value="{{ $topic->order }}"
                        class="bg-gray-200 w-3/4 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="flex items-center justify-between w-1/4">
                    <label class="block text-gray-500 font-bold text-right pr-2 w-1/4" for="points">
                        Points
                    </label>
                    <input type="number" name="points" id="points" value="{{ $topic->points }}"
                        class="bg-gray-200 w-3/4 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
                <div class="flex items-center justify-between w-1/4">
                    <label class="block text-gray-500 font-bold text-right pr-2 w-1/4" for="status">
                        Status
                    </label>
                    <div class="w-3/4 flex items-center">
                        <input type="checkbox" name="status" id="status" class="mx-2"
                        {{ $topic->status === 1 ? 'checked' : '' }}>
                        <br>
                        <span class="text-sm text-gray-500">
                            Unchecked = hidden <br> Checked = visible
                        </span> 
                    </div> 
                </div>
        </div>

        <div class="flex items-center">
            <div class="color-button font-semibold justify-center mx-auto text-center flex items-center p-4">
                <button type="submit">
                    Save changes
                </button>
            </div>
        </div>
    </form>  
</div>
@endsection
