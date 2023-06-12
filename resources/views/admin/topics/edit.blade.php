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
        class="w-full max-w-sm m-auto justify-center pb-10">
        @csrf
        @method('PUT')
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="lesson_id">
                    Lesson
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="lesson_id" id="lesson_id"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    <option value="">Choose a lesson</option>
                    @foreach ($lessons as $lesson)
                        <option value="{{ $lesson->id }}" {{ $lesson->id === $topic->lesson_id ? 'selected' : '' }}>{{ $lesson->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                    Name
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" id="name" name="name" value="{{ $topic->name }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="category">
                    Category
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="category" id="category"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <option value="">Choose a category</option>
                <option value="grammar" {{ $topic->category === 'grammar' ? 'selected' : '' }}>Grammar</option>  
                <option value="vocabulary" {{ $topic->category === 'vocabulary' ? 'selected' : '' }}>Vocabulary</option>  
            </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="order">
                    Order
                </label>
            </div>
            <div class="md:w-1/3">
                <input type="number" name="order" id="order" value="{{ $topic->order }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="points">
                    Points
                </label>
            </div>
            <div class="md:w-1/3">
                <input type="number" name="points" id="points" value="{{ $topic->points }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <label class="md:w-2/3 block text-gray-500 font-bold" for="status">
                Status
                <br />
                <input type="checkbox" name="status" id="status" class="mr-2 leading-tight">
                <span class="text-sm"> <br />
                    Unchecked = Hidden, checked = visible
                </span>
            </label>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="explanation1">
                    Explanation pt. 1
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="explanation1" id="explanation1" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $topic->explanation1 }}</textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="explanation2">
                    Explanation pt. 2
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="explanation2" id="explanation2" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $topic->explanation2 }}</textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="explanation3">
                    Explanation pt. 3
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="explanation3" id="explanation3" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $topic->explanation3 }}</textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="explanation4">
                    Explanation pt. 4
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="explanation4" id="explanation4" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $topic->explanation4 }}</textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="explanation5">
                    Explanation pt. 5
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="explanation5" id="explanation5" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $topic->explanation5 }}</textarea>
            </div>
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
