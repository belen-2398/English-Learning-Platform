@extends('layouts.admin')
@section('title', 'Topic Create')
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
    <div class="m-6 p-4 flex justify-between items-center">
        <h2 class="head-title">Create topic</h2>
        <div class="float-end">
            <a href="{{ route('topics.index') }}" class="color-button p-3">Back</a>
        </div>
    </div>
    <form action="{{ route('topics.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 pb-10 gap-4 mx-8">
            <div class="flex items-center mb-6 px-12 justify-between">
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
            <div class="flex items-center mb-6 px-12 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="lesson_id">
                        Lesson
                    </label>
                </div>
                <div class="w-3/4">
                    <select name="lesson_id" id="lesson_id"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        <option value="">Choose lesson</option>
                        @foreach ($lessons as $level => $levelLessons)
                            <optgroup label="{{ $level }}"> 
                                @foreach ($levelLessons as $lesson)
                                    <option value="{{ $lesson->id }}"
                                        {{ (old('lesson_id') === $lesson->id || (isset($lessonId) && trim($lessonId) === trim($lesson->id) )) ? 'selected' : '' }}>
                                        {{ $lesson->name }}
                                    </option>
                                @endforeach
                            </optgroup> 
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center mb-6 px-12 justify-between">
                <div class="">
                    <label class="block text-gray-500 font-bold text-right mb-1 md pr-2" for="category">
                        Category
                    </label>
                </div>
                <div class="w-3/4">
                    <select name="category" id="category"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    <option value="">Choose category</option>
                    <option value="grammar" {{ old('category') === 'grammar' ? 'selected' : '' }}>Grammar</option>
                    <option value="vocabulary" {{ old('category') === 'vocabulary' ? 'selected' : '' }}>Vocabulary</option>
                </select>
                </div>
            </div>
            <div class="flex items-center mb-6 px-12 justify-between">
                <div>
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="order">
                        Topic order
                    </label>
                </div>
                <div class="w-3/4">
                    <input type="number" name="order" id="order" value="{{ old('order') }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="flex items-center mb-6 px-12 justify-between">
                <div>
                    <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="points">
                        Points
                    </label>
                </div>
                <div class="w-3/4">
                    <input type="number" name="points" id="points" value="{{ old('points') }}"
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                </div>
            </div>
            <div class="flex items-center mb-6 px-12">
                <label class="block text-gray-500 font-bold text-right mb-1 pr-2" for="status">
                    Visible?
                </label>
                <input type="checkbox" name="status" id="status" class="ml-16 mr-4">
                <span class="text-sm text-gray-500">
                    Unchecked = hidden <br> Checked = visible
                </span>   
            </div>
        </div>
        <div class="flex items-center">
            <div class="color-button font-semibold justify-center mx-auto text-center flex items-center py-2 px-3">
                <button type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>  
</div>
@endsection
