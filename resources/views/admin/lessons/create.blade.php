@extends('layouts.admin')
@section('title', 'Lesson Create')
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
        <h2 class="head-title">Create lesson</h2>
        <a href="{{ route('lessons.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('lessons.store') }}" method="POST"
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
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="description">
                    Description
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea type="text" name="description" id="description" rows="3"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('description') }}</textarea>
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
                    Unchecked = hidden <br> Checked = visible
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
            const level = document.getElementById('level').value;
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const order = document.getElementById('order').value;

            if (level && name && description && order) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        const requiredFields = document.querySelectorAll('#level, #name, #description, #order');
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
