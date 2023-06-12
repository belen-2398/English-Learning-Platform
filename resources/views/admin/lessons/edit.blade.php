@extends('layouts.admin')
@section('title', 'Edit Lesson')
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
        <h2 class="head-title">Edit lesson</h2>
        <a href="{{ route('lessons.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('lessons.update', $lesson->id) }}" method="POST"
        class="w-full max-w-sm m-auto justify-center pb-10">
        @csrf
        @method('PUT')
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                    Level
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="level" id="level"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <option value="">Choose a level</option>
                <option value="A1" {{ $lesson->level === 'A1' ? 'selected' : '' }}>A1</option>
                <option value="A2" {{ $lesson->level === 'A2' ? 'selected' : '' }}>A2</option>
                <option value="B1" {{ $lesson->level === 'B1' ? 'selected' : '' }}>B1</option>
                <option value="B2" {{ $lesson->level === 'B2' ? 'selected' : '' }}>B2</option>
                <option value="C1" {{ $lesson->level === 'C1' ? 'selected' : '' }}>C1</option>
                <option value="C2" {{ $lesson->level === 'C2' ? 'selected' : '' }}>C2</option>
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
                <input type="text" id="name" name="name" value="{{ $lesson->name }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="description">
                    Description
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="description" id="description" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ $lesson->description }}</textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="order">
                    Order
                </label>
            </div>
            <div class="md:w-1/3">
                <input type="number" name="order" id="order" value="{{ $lesson->order }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <label class="md:w-2/3 block text-gray-500 font-bold" for="status">
                status?
                <br />
                <input type="checkbox" name="status" id="status" class="mr-2 leading-tight"
                    {{ $lesson->status === 1 ? 'checked' : '' }}>
                <span class="text-sm"> <br />
                    Unchecked = Hidden, checked = visible
                </span>
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
