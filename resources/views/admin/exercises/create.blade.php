@extends('layouts.admin')
@section('title', 'Exercise Create')
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
        <h2 class="head-title">Create exercise</h2>
        <a href="{{ route('exercises.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('exercises.store') }}" method="POST"
        class="w-full max-w-sm m-auto justify-center pb-10">
        @csrf
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="level">
                    Level
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="level" id="level"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <option value="">Choose a level</option>
                <option value="A1" {{ old('level') === 'A1' ? 'selected' : '' }}>A1</option>
                <option value="A2" {{ old('level') === 'A2' ? 'selected' : '' }}>A2</option>
                <option value="B1" {{ old('level') === 'B1' ? 'selected' : '' }}>B1</option>
                <option value="B2" {{ old('level') === 'B2' ? 'selected' : '' }}>B2</option>
                <option value="C1" {{ old('level') === 'C1' ? 'selected' : '' }}>C1</option>
                <option value="C2" {{ old('level') === 'C2' ? 'selected' : '' }}>C2</option>
            </select>
            </div>
        </div>
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
                    <option value="{{ $lesson->id }}" {{ old('lesson_id') === $lesson->id ? 'selected' : '' }}>
                        {{ $lesson->name }}
                    </option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="lesson_id">
                    topic
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="topic_id" id="topic_id"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <option value="">Choose a topic</option>
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}" {{ old('topic_id') === $topic->id ? 'selected' : '' }}>
                        {{ $topic->name }}
                    </option>
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
                <input type="text" id="name" name="name" value="{{ old('name') }}"
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
                <option value="grammar" {{ old('category') === 'grammar' ? 'selected' : '' }}>Grammar</option>
                <option value="vocabulary" {{ old('category') === 'vocabulary' ? 'selected' : '' }}>Vocabulary</option>
                <option value="mixed" {{ old('category') === 'mixed' ? 'selected' : '' }}>Mixed</option>
            </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="type">
                    Type
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="type" id="type"
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                <option value="">Choose a type</option>
                <option value="match" {{ old('type') === 'match' ? 'selected' : '' }}>Match</option>
                <option value="fill" {{ old('type') === 'fill' ? 'selected' : '' }}>Fill</option>
                <option value="select" {{ old('type') === 'select' ? 'selected' : '' }}>Select</option>
                <option value="order" {{ old('type') === 'order' ? 'selected' : '' }}>Order</option>
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
                <input type="number" name="order" id="order" value="{{ old('order') }}"
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;

        function checkRequiredFields() {
            const name = document.getElementById('name').value;

            if (name) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        const requiredFields = document.querySelectorAll('#name');
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
