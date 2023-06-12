@extends('layouts.admin')
@section('title', 'Slider Create')
@section('content')
<div>
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>
    @endif
    <div class="m-6 p-4 flex justify-between">
        <h2 class="head-title">Create Slider</h2>
        <a href="{{ route('sliders.index') }}" class="color-button float-end p-3">Back</a>
    </div>
    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data"
        class="w-full max-w-sm m-auto justify-center pb-10">
        @csrf
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
                    Title
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" id="title" name="title" value="{{ old('title') }}"
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
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="link">
                    Link
                </label>
            </div>
            <div class="md:w-2/3">
                <input type="text" name="link" id="link" value="{{ old('link') }}"
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
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
            const title = document.getElementById('title').value;

            if (title) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        const requiredFields = document.querySelectorAll('#title');
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
